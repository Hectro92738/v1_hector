<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submenu;

use Illuminate\Support\Facades\Storage;

class SubmenuController extends Controller
{
    public function get_Submenu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $submenus = Submenu::all();
        
            if ($submenus->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'msj' => 'No se encontraron menús',
                ]);
            }
            
            return response()->json([
                'status' => 200,
                'submenus' => $submenus,
                'msj' => 'Menús encontrados',
            ]);
            //--------------------------------------------------------
        } else {
            return response()->json([
                'status' => 700,
                'msj' => 'Sesión inválida',
            ]);
        }
    }
    public function ubdate_Estatus_Submenu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            // Verifica si el menú está activo ("A") o inactivo ("I")
            $id = $request->input('id');
            $menu = Submenu::find($id);

            if ($menu) {
                $nuevoEstatus = ($menu->ESTATUS == "A") ? "I" : "A";
                $menu->ESTATUS = $nuevoEstatus;
                $menu->save();

                return response()->json([
                    'status' => 200,
                    'msj' => 'Estatus Actualizado',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Menú no encontrado',
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
    public function Eliminar_SubMenu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $id = $request->input('id');
            $menu = Submenu::find($id);

            if ($menu) {
                // Intentar eliminar el Sub-menú
                try {
                    $menu->delete();
                    return response()->json([
                        'status' => 200,
                        'msj' => 'Sub-Menú eliminado exitosamente',
                    ]);
                } catch (\Exception $e) {
                    // Si se lanza una excepción, devuelve una respuesta con estado 500
                    return response()->json([
                        'status' => 500,
                        'msj' => 'Este Sub-menú está asignado',
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Sub-Menú no encontrado',
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
    public function insert_SubMenu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $nombre = $request->input('modal-nombre-sub');
            $icono = $request->input('modal-icono');
            // Verificar si el nombre o el icono ya existen
            $menuExistente = Submenu::where('NAME_SUBMENU', $nombre)->orWhere('ICON_SUB', $icono)->first();

            if ($menuExistente) {
                return response()->json([
                    'status' => 400,
                    'msj' => 'El nombre o el icono ya existen',
                ]);
            } else {
                // Insertar en la base de datos con ESTATUS "I"
                Submenu::create([
                    'NAME_SUBMENU' => $nombre,
                    'ESTATUS' => 'I',
                    'ICON_SUB' => $icono,
                ]);

                return response()->json([
                    'status' => 200,
                    'msj' => 'Sub-Menú insertado correctamente.',
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
    public function getSubMenu_Editar(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $id = $request->input('id');

            $menu = Submenu::find($id);

            if ($menu) {
                // Si se encuentra el Sub-menú, devuelve sus datos
                return response()->json([
                    'status' => 200,
                    'menu' => $menu,
                    'msj' => 'Sub-Menú encontrado',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'msj' => 'Sub-Menú no encontrado',
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
    public function insert_SubMenu_Editado(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $nombre = $request->input('modal-nombre-edi-sub');
            $id = $request->input('id_submenu');
            $icono = $request->input('modal-icono');
            
            // Validar si $icono no está vacío o nulo
            if (!empty($icono)) {
                $menu = Submenu::find($id);
                $icon = Submenu::where('ICON_SUB', $icono)->first();
                if ($icon) {
                    return response()->json([
                        'status' => 400,
                        'msj' => 'El icono ya está en uso',
                    ]);
                } else
                if ($menu) {
                    $menu->ICON_SUB = $icono;
                    $menu->NAME_SUBMENU = $nombre;
                    $menu->save();
                }
            }
            
            // Realizar cambios en la base de datos con el nombre y el ID
            $menu = Submenu::find($id);
            if ($menu) {
                $menu->NAME_SUBMENU = $nombre;
                $menu->save();
            }
            
            return response()->json([
                'status' => 200,
                'msj' => 'Cambios guardados exitosamente',
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
