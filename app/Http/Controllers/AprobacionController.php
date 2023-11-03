<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aprobacion;

class AprobacionController extends Controller
{
   public function get_aprobacion(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $empNum = $request->numEmp;
         // Busca si ya existe un registro con el EMP_NUM
         $Aprobaciones = Aprobacion::where('EMP_NUM_MANDO', $empNum)->get();
         if ($Aprobaciones) {
            return response()->json([
               'aprobaciones' => $Aprobaciones,
               'status' => 200,
               'msj'    => 'Aprobaciones encontradas',
            ]);
         } else {
            return response()->json([
               'status' => 300,
               'msj'    => 'Aprobaciones no creadas',
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
