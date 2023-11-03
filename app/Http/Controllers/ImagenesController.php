<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagenes;

use Illuminate\Support\Facades\Storage;

class ImagenesController extends Controller
{
    public function get_Img(Request $request)
    {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $Datos = Imagenes::all();

            if ($Datos->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'msj' => 'No se encontraron Datos en imagenes',
                ]);
            }

            return response()->json([
                'status' => 200,
                'datos' => $Datos,
                'msj' => 'datos encontrados de imagenes',
            ]);
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión inválida',
         ]);
      }
    }
    public function inret_IMGRoute(Request $request)
    {
        $token = $request->query('token');
        $storedToken = $_COOKIE['session_token'] ?? null;
        if ($storedToken && $token === $storedToken) {
           //--------------------------------------------------------
           $file = $request->file('modal_img');
           $accion = $request->input('modal_img_animacion');
  
           // Busca si ya existe un registro con el ACTION
           $existingImg = Imagenes::where('ACTION', $accion)->first();
           if ($existingImg) {
              // Si el registro existe, actualiza la columna IMG con la nueva imagen
              $fileName = time() . '.' . $file->getClientOriginalExtension();
              $file->storeAs('images', $fileName);
              // Elimina la imagen anterior de la carpeta de images .getcwd()
              Storage::delete('images/' . $existingImg->IMG);
              // Actualiza la imagen en la base de datos
              $existingImg->update(['IMG' => $fileName]);
              return response()->json([
                 'status' => 200,
                 'msj'    => 'Imagen actualizada',
              ]);
           } else {
              // Si el registro no existe, crea uno nuevo
              $fileName = time() . '.' . $file->getClientOriginalExtension();
              $file->storeAs('images', $fileName);
              $empData = ['ACTION' => $accion, 'IMG' => $fileName];
              Imagenes::create($empData);
  
              return response()->json([
                 'status' => 200,
                 'msj'    => 'Imagen Insertada',
              ]);
           }
           //--------------------------------------------------------
        } else {
           return response()->json([
              'status' => 700,
              'msj'    => 'Sesión inválida',
           ]);
        }
    }
}
