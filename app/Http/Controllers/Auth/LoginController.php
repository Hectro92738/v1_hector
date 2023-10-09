<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        //dd($email);
        $user = User::where('EMAIL', $email)
            ->where('EMP_NUM', $password)
            ->where('ESTATUS', 'A')
            ->first();

        if (Auth::attempt($user)) {
            // La autenticación fue exitosa, redirige a donde sea necesario.
            return redirect()->intended('/Crud');
        }

        // La autenticación falló, redirige de nuevo al formulario de inicio de sesión con un mensaje de error.
        return redirect()->back()->withErrors(['email' => 'Credenciales inválidas']);
    }
}
