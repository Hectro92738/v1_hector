<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menuSubmenu;

use Illuminate\Support\Facades\Storage;

class menuSubmenuController extends Controller
{

    public function get_MenuSubmenu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $numEmp = $request->input('numEmp');

            // Realiza una consulta en la tabla menu_submenu para obtener los datos según EMP_NUM
            $menuSubmenu = menuSubmenu::with(['menu', 'submenu'])
                ->where('EMP_NUM', $numEmp)
                ->get();

            // Devuelve los datos en formato JSON
            return response()->json([
                'status' => 200,
                'datos' => $menuSubmenu,
                'msj' => 'Menús y submenús encontrados'
            ]);
            
        } else {
            //--------------------------------------------------------
            return response()->json([
                'status' => 700,
                'msj'    => 'Sesión inválida',
            ]);
        }
    }
}
