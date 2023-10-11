<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
   public function index()
   {
      return view('login');
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

   public function Crud($token)
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


   //********************************************************************************************
   public function fetchAll(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $employees = Employee::all();
         if ($employees->count() > 0) {
            return response()->json([
               'status' => 200,
               'obj' => $employees,
            ]);
         } else {
            return response()->json([
               'status' => 404,
               'message' => 'No employees found in the database.',
            ]);
         }
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión invalida',
         ]);
      }
   }
   public function store(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $file = $request->file('avatar');
         $fileName = time() . '.' . $file->getClientOriginalExtension();
         $file->storeAs('public/images', $fileName); //php artisan store:link
         $empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'avatar' => $fileName];
         Employee::create($empData);
         return response()->json([
            'status' => 200,
         ]);
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión invalida',
         ]);
      }
   }
   public function dropProduct(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         $id = $request->input('id'); // Obtén el ID del producto desde la solicitud
         // Busca el producto por su ID
         $employee = Employee::find($id);
         if (!$employee) {
            return response()->json([
               'status' => 404,
               'msj' => 'producto no encontrado.',
            ]);
         }
         // Elimina el registro del producto de la base de datos
         $employee->delete();
         // Elimina también el archivo de avatar asociado, si existe
         if ($employee->avatar) {
            Storage::delete('public/images/' . $employee->avatar);
         }
         return response()->json([
            'status' => 200,
            'msj' => 'producto eliminado',
         ]);
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión invalida',
         ]);
      }
   }
   public function editProduct(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         // Obtén el ID del producto de la solicitud
         $id = $request->input('id');
         // Consulta la base de datos para obtener la información del producto
         $product = Employee::find($id);
         // Verifica si el producto existe
         if ($product) {
            // Si el producto existe, devuélvelo como respuesta JSON
            return response()->json([
               'status' => 200,
               'obj' => $product,
            ]);
         } else {
            // Si el producto no se encuentra, devuelve un mensaje de error
            return response()->json([
               'status' => 404,
               'msj' => 'Producto no encontrado.',
            ]);
         }
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión invalida',
         ]);
      }
   }

   public function updateProduct(Request $request)
   {
      $token = $request->query('token');
      $storedToken = $_COOKIE['session_token'] ?? null;
      if ($storedToken && $token === $storedToken) {
         //--------------------------------------------------------
         // Obtén el ID del producto que deseas actualizar
         $id = $request->input('id');
         // Busca el producto en la base de datos
         $product = Employee::find($id);
         // Verifica si el producto existe
         if ($product) {
            $product->first_name = $request->input('first_name');
            $product->last_name = $request->input('last_name');
            $product->email = $request->input('email');
            if ($request->hasFile('avatar')) {
               // Elimina la imagen anterior si existe
               Storage::delete('public/images/' . $product->avatar);
               // Sube la nueva imagen y almacena el nombre en la base de datos
               $file = $request->file('avatar');
               $fileName = time() . '.' . $file->getClientOriginalExtension();
               $file->storeAs('public/images', $fileName);
               $product->avatar = $fileName;
            }
            // Guarda los cambios en el producto
            $product->save();
            // Devuelve una respuesta exitosa
            return response()->json([
               'status' => 200,
               'message' => 'Producto actualizado con éxito.',
            ]);
         } else {
            // Si el producto no se encuentra, devuelve un mensaje de error
            return response()->json([
               'status' => 404,
               'message' => 'Producto no encontrado.',
            ]);
         }
         //--------------------------------------------------------
      } else {
         return response()->json([
            'status' => 700,
            'msj'    => 'Sesión invalida',
         ]);
      }
   }
}
