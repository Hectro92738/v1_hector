<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;

use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
   public function avatar($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.avatar');
         //--------------------------------------------------------
      } else {
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }

   public function insert_avatar(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $file = $request->file('modal_avatar');
         $empNum = $request->numEmp;

         // Busca si ya existe un registro con el EMP_NUM
         $existingAvatar = Avatar::where('EMP_NUM', $empNum)->first();

         if ($existingAvatar) {
            // Si el registro existe, actualiza la columna IMG con la nueva imagen
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $fileName);
            // Elimina la imagen anterior de la carpeta de avatars
            Storage::delete('public/avatars/' . $existingAvatar->IMG);
            // Actualiza la imagen en la base de datos
            $existingAvatar->update(['IMG' => $fileName]);
            return response()->json([
               'status' => 200,
               'msj'    => 'Avatar actualizado',
            ]);
         } else {
            // Si el registro no existe, crea uno nuevo
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/avatars', $fileName);
            $empData = ['EMP_NUM' => $empNum, 'IMG' => $fileName];
            Avatar::create($empData);

            return response()->json([
               'status' => 200,
               'msj'    => 'Avatar creado',
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
   public function get_avatar(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $empNum = $request->numEmp;
         // Busca si ya existe un registro con el EMP_NUM
         $avatar = Avatar::where('EMP_NUM', $empNum)->first();
         if ($avatar) {
            return response()->json([
               'status' => 200,
               'img'    => $avatar->IMG,
               'msj'    => 'Avatar encontrado',
            ]);
         } else {
            return response()->json([
               'status' => 300,
               'msj'    => 'Avatar no creado',
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

   public function delete_avatar(Request $request)
   {
       $token = $request->query('token');
       $storedToken = $_COOKIE['session_token'] ?? null;
   
       if ($storedToken && $token === $storedToken) {
           //--------------------------------------------------------
           $numEmp = $request->input('numEmp'); // Obtén el EMP_NUM
           // Busca el avatar por su EMP_NUM
           $avatar = Avatar::where('EMP_NUM', $numEmp)->first();
           if (!$avatar) {
               return response()->json([
                   'status' => 404,
                   'msj'    => 'Avatar no encontrado',
               ]);
           }
           // Elimina el registro de la base de datos
           $avatar->delete();
           
           // Elimina también el archivo de avatar asociado, si existe
           Storage::delete('public/avatars/' . $avatar->IMG);
           return response()->json([
               'status' => 200,
               'msj'    => 'Avatar eliminado',
           ]);
           //--------------------------------------------------------
       } else {
           return response()->json([
               'status' => 700,
               'msj'    => 'Sesión inválida',
           ]);
       }
   }

   


}
