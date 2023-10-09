<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

// Route::get('/', function () {
//     return view('welcome');
// });
//Este es la view de loguin
Route::get('/', [EmployeeController::class, 'index'])->name('index');
Route::get('/email_recuperacion', [EmployeeController::class, 'email_recuperacion'])->name('email_recuperacion');
Route::get('/cambio_password/{fecha}', [EmployeeController::class, 'cambio_password'])->name('cambio_password');


//controlador AuthController Sesión  match(['get', 'post'], '
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update_Password', [AuthController::class, 'eupdatePassword'])->name('eupdatePassword');
Route::post('/update_Password_secion', [AuthController::class, 'eupdatePasswordSecion'])->name('eupdatePasswordSecion');
Route::post('/getName', [AuthController::class, 'getName'])->name('getName');
Route::post('/verificaEmailExiste', [AuthController::class, 'verificaEmailExiste'])->name('verificaEmailExiste');




Route::match(['get', 'post'], '/home/{token}', [EmployeeController::class, 'home'])->name('home');
Route::match(['get', 'post'], '/Crud/{token}', [EmployeeController::class, 'Crud'])->name('Crud');
Route::match(['get', 'post'], '/login_cambio_Pasword/{token}', [EmployeeController::class, 'login_cambio_Pasword'])->name('login_cambio_Pasword');
//view una vez que inisie sesión  ->middleware('auth')
//inserta un registro nuevo
Route::post('/store', [EmployeeController::class, 'store'])->name('store');
//elimina un producto
Route::post('/drop-product', [EmployeeController::class, 'dropProduct'])->name('dropProduct');
//consulta los datos a la base
Route::post('/edit-product', [EmployeeController::class, 'editProduct'])->name('editProduct');
//actualiza los datos
Route::post('/insert-product', [EmployeeController::class, 'updateProduct'])->name('updateProduct');
//Muestra en la pantalla los productos q exixten en la base de datos.... automaticamente
Route::get('/fetchAll', [EmployeeController::class, 'fetchAll'])->name('fetchAll');






Route::middleware(['auth'])->group(function () {
});
