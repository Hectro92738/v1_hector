<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\XxhrEstructuraUteq;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = XxhrEstructuraUteq::where('EMAIL', $email)
            ->where('ESTATUS', 'A')
            ->first();

        if ($user) {
            if ($user->PASSWORD == '0') {
                // El empleado debe cambiar su contraseña
                if ($password == $user->EMP_NUM) {
                    // El empleado inicia sesión con EMP_NUM
                    Auth::login($user); // Autentica al usuario
                    return response()->json([
                        'success' => true,
                        'email' => $user->EMAIL,
                        'numEmp' => $user->EMP_NUM,
                        'changePassword' => true,
                    ]);
                }
            } else {
                // El empleado ya ha cambiado su contraseña
                if (Hash::check($password, $user->PASSWORD)) {
                    // El empleado inicia sesión con PASSWORD
                    Auth::login($user); // Autentica al usuario
                    return response()->json([
                        'success' => true,
                        'email' => $user->EMAIL,
                        'numEmp' => $user->EMP_NUM,
                        'changePassword' => false, // Indicar que no es necesario cambiar la contraseña
                    ]);
                }
            }
        }
        return response()->json([
            'success' => false,
            'msj'    => 'Datos Incorrectos',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function eupdatePassword(Request $request)
    {
        // Validar los datos recibidos
        $email = $request->input('correo');
        $password = $request->input('password');

        // Buscar el usuario por su correo
        $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

        // Si no se encuentra el usuario, retornar un error
        if (!$user) {
            return response()->json([
                'status' => 400,
                'msj'    => 'Email no existe',
            ]);
        }
        // Generar el hash de la nueva contraseña
        $hashedPassword = Hash::make($password);
        // Actualizar la contraseña del usuario con el hash generado
        $user->password = $hashedPassword;
        $user->save();
        return response()->json([
            'status' => 200,
            'msj'    => 'Tu contraseña a sido actualizada correctamente',
        ]);
    }

    public function eupdatePasswordSecion(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------

            // Validar los datos recibidos
            $email = $request->input('correo');
            $password = $request->input('password');

            // Buscar el usuario por su correo
            $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

            // Si no se encuentra el usuario, retornar un error
            if (!$user) {
                return response()->json([
                    'status' => 400,
                    'msj'    => 'Email no existe',
                ]);
            }
            // Generar el hash de la nueva contraseña
            $hashedPassword = Hash::make($password);
            // Actualizar la contraseña del usuario con el hash generado
            $user->password = $hashedPassword;
            $user->save();
            return response()->json([
                'status' => 200,
                'msj'    => 'Tu contraseña a sido generada con exito, ahora ya puedes Iniciar Seción con ella',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj'    => 'Sesión invalida',
            ]);
        }
    }

    public function getName(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            // Validar los datos recibidos
            $email = $request->input('correo');

            // Buscar el usuario por su correo
            $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

            // Si no se encuentra el usuario, retornar un error
            if (!$user) {
                return response()->json([
                    'status' => 400,
                    'msj'    => 'Email no existe',
                ]);
            }
            return response()->json([
                'status' => 200,
                'nombre' => $user->EMP_NAME,
            ]);         //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj'    => 'Sesión invalida',
            ]);
        }
    }
    public function verificaEmailExiste(Request $request)
    {
        // Validar los datos recibidos
        $email = $request->input('email');

        // Buscar el usuario por su correo
        $user = XxhrEstructuraUteq::where('EMAIL', $email)->first();

        // Si no se encuentra el Email, retornar un error
        if (!$user) {
            return response()->json([
                'status' => 400,
                'msj'    => 'El correo no existe',
            ]);
        }
        return response()->json([
            'status' => 200,
            'msj'    => 'URL eviado',
        ]);         //--------------------------------------------------------

    }
}
