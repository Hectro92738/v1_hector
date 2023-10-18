<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\menuSubmenuController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/
//---------------------------------------------------------------------------------------------------------------
//-------------------------| AuthController - TABLE XXHR_ESTRUCTURA_UTEQ |---------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update_Password', [AuthController::class, 'eupdatePassword'])->name('eupdatePassword');
Route::post('/update_Password_secion', [AuthController::class, 'eupdatePasswordSecion'])->name('eupdatePasswordSecion');
Route::post('/getName', [AuthController::class, 'getName'])->name('getName');
Route::post('/verificaEmailExiste', [AuthController::class, 'verificaEmailExiste'])->name('verificaEmailExiste');
Route::post('/get_Menu', [AuthController::class, 'get_Menu'])->name('getMenu');
Route::post('/informacion_personal', [AuthController::class, 'informacion_personal'])->name('informacionPersonal');
//---------------------------------------------------------------------------------------------------------------
//---------------------------------| AvatarController - TABLE AVATARS |------------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::match(['get', 'post'], '/insert_avatar', [AvatarController::class, 'insert_avatar'])->name('insertAvatar');
Route::post('/get_avatar', [AvatarController::class, 'get_avatar'])->name('getAvatar');
Route::post('/delete_avatar', [AvatarController::class, 'delete_avatar'])->name('delateAvatar');
//---------------------------------------------------------------------------------------------------------------
//-----------------------------| menuSubmenuController - TABLE MENU_SUBMENU |------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/get_MenuSubmenu', [menuSubmenuController::class, 'get_MenuSubmenu'])->name('getMenuSubmenu');
//---------------------------------------------------------------------------------------------------------------
//-----------------------------------| URLController - RUTAS URL |-----------------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::get('/email_recuperacion', [URLController::class, 'email_recuperacion'])->name('email_recuperacion');
Route::get('/cambio_password/{fecha}', [URLController::class, 'cambio_password'])->name('cambio_password');
Route::get('/', [URLController::class, 'inicio_sesion'])->name('inicio_sesion'); 
Route::match(['get', 'post'], '/index/{token}', [URLController::class, 'index'])->name('index');
Route::match(['get', 'post'], '/home/{token}', [URLController::class, 'home'])->name('home');
Route::match(['get', 'post'], '/login_cambio_Pasword/{token}', [URLController::class, 'login_cambio_Pasword'])->name('login_cambio_Pasword');
Route::match(['get', 'post'], '/avatar/{token}', [URLController::class, 'avatar'])->name('Avatar');
//..--- MENU ---..
Route::match(['get', 'post'], '/documentos_personales/{token}', [URLController::class, 'documentos_personales'])->name('documentos_personales');
Route::match(['get', 'post'], '/permisos_economicos/{token}', [URLController::class, 'permisos_economicos'])->name('permisos_economicos');
Route::match(['get', 'post'], '/panel_de_rh/{token}', [URLController::class, 'panel_de_rh'])->name('panel_de_rh');



