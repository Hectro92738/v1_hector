<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function get_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $menus = Menu::all();

            if ($menus->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'msj' => 'No se encontraron menús',
                ]);
            }

            return response()->json([
                'status' => 200,
                'menus' => $menus,
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
    public function ubdate_Estatus_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            // Verifica si el menú está activo ("A") o inactivo ("I")
            $id = $request->input('id');
            $menu = Menu::find($id);

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
    public function insert_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $nombre = $request->input('modal-nombre');
            $icono = $request->input('modal-icono');
            // Verificar si el nombre o el icono ya existen
            $menuExistente = Menu::where('NAME_MENU', $nombre)->orWhere('ICON_MENU', $icono)->first();

            if ($menuExistente) {
                return response()->json([
                    'status' => 400,
                    'msj' => 'El nombre o el icono ya existen.',
                ]);
            } else {
                // Insertar en la base de datos con ESTATUS "I"
                Menu::create([
                    'NAME_MENU' => $nombre,
                    'ESTATUS' => 'I',
                    'ICON_MENU' => $icono,
                ]);

                return response()->json([
                    'status' => 200,
                    'msj' => 'Menú insertado correctamente.',
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
    public function Eliminar_Menu(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $id = $request->input('id');
            // Buscar el menú por ID
            $menu = Menu::find($id);

            if ($menu) {
                // Intentar eliminar el menú
                try {
                    $menu->delete();
                    return response()->json([
                        'status' => 200,
                        'msj' => 'Menú eliminado exitosamente',
                    ]);
                } catch (\Exception $e) {
                    // Si se lanza una excepción, devuelve una respuesta con estado 500
                    return response()->json([
                        'status' => 500,
                        'msj' => 'Este menú está asignado',
                    ]);
                }
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
    public function getMenu_Editar(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $id = $request->input('id');
            // Buscar el menú por ID
            // Buscar el menú por ID
            $menu = Menu::find($id);

            if ($menu) {
                // Si se encuentra el menú, devuelve sus datos
                return response()->json([
                    'status' => 200,
                    'menu' => $menu,
                    'msj' => 'Menú encontrado',
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
    public function insert_Menu_Editado(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
            //--------------------------------------------------------
            $nombre = $request->input('modal-nombre-edi');
            $id = $request->input('id_menu');
            $icono = $request->input('modal-icono');

            // Validar si $icono no está vacío o nulo
            if (!empty($icono)) {
                $menu = Menu::find($id);
                $icon = Menu::where('ICON_MENU', $icono)->first();
                if ($icon) {
                    return response()->json([
                        'status' => 400,
                        'msj' => 'El icono ya está en uso',
                    ]);
                } else
                if ($menu) {
                    $menu->ICON_MENU = $icono;
                    $menu->NAME_MENU = $nombre;
                    $menu->save();
                }
            }

            // Realizar cambios en la base de datos con el nombre y el ID
            $menu = Menu::find($id);
            if ($menu) {
                $menu->NAME_MENU = $nombre;
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
