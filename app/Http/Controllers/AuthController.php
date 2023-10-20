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
        $email = $request->input('modal-email');
        $password = $request->input('modal-password');

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
                        'name' => 'Bienvenid(@) ' . $user->EMP_NAME,
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
                        'name' => 'Bienvenid(@) ' . $user->EMP_NAME,
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
    public function get_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;

        if ($storedToken && $token === $storedToken) {
            $numEmp = $request->input('numEmp');

            // Buscar el usuario por EMP_NUM
            $user = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->first();

            if ($user) {
                $POS_TIPO_DESC = $user->POS_TIPO_DESC;
                $NOM_NAME_1 = $user->NOM_NAME_1;

                return response()->json([
                    'status' => 200,
                    'POS_TIPO_DESC' => $POS_TIPO_DESC,
                    'NOM_NAME_1' => $NOM_NAME_1,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Usuario no encontrado - menu',
                ]);
            }
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function informacion_personal(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $numEmp = $request->input('numEmp');

            // Buscar el usuario por EMP_NUM
            $user = XxhrEstructuraUteq::where('EMP_NUM', $numEmp)->first();

            if ($user) {
                $POS_NAME = $user->POS_NAME;
                $EMP_NAME = $user->EMP_NAME;
                $EMAIL = $user->EMAIL;
                $EMP_CURP = $user->EMP_CURP;
                $EMP_IMSS = $user->EMP_IMSS;
                $EMP_BIRTHDATE = $user->EMP_BIRTHDATE;

                return response()->json([
                    'status' => 200,
                    'POS_NAME' => $POS_NAME,
                    'EMP_NAME' => $EMP_NAME,
                    'EMAIL' => $EMAIL,
                    'EMP_CURP' => $EMP_CURP,
                    'EMP_IMSS' => $EMP_IMSS,
                    'EMP_BIRTHDATE' => $EMP_BIRTHDATE,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Usuario no encontrado - menu',
                ]);
            }
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function getAll_Empleados(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $empleados = XxhrEstructuraUteq::all();
        
            if ($empleados->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'msj' => 'No se encontraron empleados',
                ]);
            }
            
            return response()->json([
                'status' => 200,
                'empleados' => $empleados,
                'msj' => 'empleados encontrados',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
}
