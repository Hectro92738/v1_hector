<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class URLController extends Controller
{
   public function inicio_sesion()
   {
      return view('inicio_sesion');
   }
   public function email_recuperacion()
   {
      return view('email.recuperacion');
   }
   public function cambio_password()
   {
      return view('email.cambioPassword');
   }

   public function home($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.home');
         //--------------------------------------------------------
      } else {
         // El token no es válido, redirige al usuario a la página de inicio de sesión
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }
   public function login_cambio_Pasword($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('login_cambioPass');
         //--------------------------------------------------------
      } else {
         // El token no es válido, redirige al usuario a la página de inicio de sesión
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }

   public function index($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.index');
         //--------------------------------------------------------
      } else {
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }
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
   //..--- MENU ---..
   public function documentos_personales($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.documentos_personales');
         //--------------------------------------------------------
      } else {
         // El token no es válido, redirige al usuario a la página de inicio de sesión
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }
   public function permisos_economicos($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.permisos_economicos');
         //--------------------------------------------------------
      } else {
         // El token no es válido, redirige al usuario a la página de inicio de sesión
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }
   public function panel_de_rh($token)
   {
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($token === $storedToken) {
         //--------------------------------------------------------
         return view('All.panel_de_rh');
         //--------------------------------------------------------
      } else {
         // El token no es válido, redirige al usuario a la página de inicio de sesión
         return redirect('/')->with('error', 'Sesión invalida');
      }
   }

}
