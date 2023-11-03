<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLController;            // NAVEGACIÓN URL - "NO TABLA"
use App\Http\Controllers\AuthController;           //INICIO DE SESIÓN
use App\Http\Controllers\AvatarController;         //TABLA DE AVATARS
use App\Http\Controllers\menuSubmenuController;    //TABLA DE MENU_SUBMENU MenuController
use App\Http\Controllers\MenuController;           // TABLA DE MENU
use App\Http\Controllers\SubmenuController;        // TABLA DE MENU
use App\Http\Controllers\ImagenesController;       // TABLA DE IMAGENES
use App\Http\Controllers\AprobacionController;     // TABLA DE Aprobaciones
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/
//---------------------------------------------------------------------------------------------------------------
//-------------------------| AuthController - TABLE "XXHR_ESTRUCTURA_UTEQ" 😒 |---------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/update_Password', [AuthController::class, 'eupdatePassword'])->name('eupdatePassword');
Route::post('/update_Password_secion', [AuthController::class, 'eupdatePasswordSecion'])->name('eupdatePasswordSecion');
Route::post('/getName', [AuthController::class, 'getName'])->name('getName');
Route::post('/verificaEmailExiste', [AuthController::class, 'verificaEmailExiste'])->name('verificaEmailExiste');
Route::post('/informacionpersonal', [AuthController::class, 'informacionpersonal'])->name('informacionPersonal');
//Trae todos los empleados "CHOSEN"
Route::match(['get', 'post'], '/getAll_Empleados', [AuthController::class, 'getAll_Empleados'])->name('getAllEmpleados');
//Trae el total de empleados en numero 
Route::match(['get', 'post'], '/get_Total_Empleados', [AuthController::class, 'get_Total_Empleados'])->name('getTotalEmpleados');
Route::match(['get', 'post'], '/conocer_tipousuarios', [AuthController::class, 'conocer_tipousuarios'])->name('conocertipousuarios');
//---------------------------------------------------------------------------------------------------------------
//---------------------------------| AvatarController - TABLE "AVATARS" 🤣 |--------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::match(['get', 'post'], '/insert_avatar', [AvatarController::class, 'insert_avatar'])->name('insertAvatar');
Route::match(['get', 'post'], '/get_avatar', [AvatarController::class, 'get_avatar'])->name('getAvatar');
Route::post('/delete_avatar', [AvatarController::class, 'delete_avatar'])->name('delateAvatar');
//---------------------------------------------------------------------------------------------------------------
//---------------------------------| MandoController - TABLE "Mandos" 😐 |--------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::match(['get', 'post'], '/get_Mandos', [MandoController::class, 'get_Mandos'])->name('getMandos');
//---------------------------------------------------------------------------------------------------------------
//---------------------------------| AprobacionController - TABLE "Aprobacion" 👌 |------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::match(['get', 'post'], '/get_aprobacion', [AprobacionController::class, 'get_aprobacion'])->name('getaprobacion');
//---------------------------------------------------------------------------------------------------------------
//-----------------------------| menuSubmenuController - TABLE "MENU_SUBMENU" 😁 |-------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/get_MenuSubmenu', [menuSubmenuController::class, 'get_MenuSubmenu'])->name('getMenuSubmenu');
Route::post('/get_menu_empleado', [menuSubmenuController::class, 'get_menu_empleado'])->name('getmenuempleado');
Route::match(['get', 'post'], '/insert_MenuEditado', [menuSubmenuController::class, 'insert_MenuEditado'])->name('insertMenusEditado');
//---------------------------------------------------------------------------------------------------------------
//----------------------------------| MenuController - TABLE "MENU" 😣 |-----------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/get_Menu', [MenuController::class, 'get_Menu'])->name('getMenu');
Route::post('/ubdate_Estatus_Menu', [MenuController::class, 'ubdate_Estatus_Menu'])->name('ubdateEstatusMenu');
Route::post('/insert_Menu', [MenuController::class, 'insert_Menu'])->name('insertMenu');
Route::post('/Eliminar_Menu', [MenuController::class, 'Eliminar_Menu'])->name('EliminarMenu');
Route::post('/getMenu_Editar', [MenuController::class, 'getMenu_Editar'])->name('getMenuEditar');
Route::post('/insert_Menu_Editado', [MenuController::class, 'insert_Menu_Editado'])->name('insertMenuEditado');
//---------------------------------------------------------------------------------------------------------------
//----------------------------------| SubmenuController - TABLE "SUBMENU" 🤣 |-----------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/get_Submenu', [SubmenuController::class, 'get_Submenu'])->name('getSubmenu');
Route::post('/ubdate_Estatus_Submenu', [SubmenuController::class, 'ubdate_Estatus_Submenu'])->name('ubdateEstatusSubmenu');
Route::post('/insert_SubMenu', [SubmenuController::class, 'insert_SubMenu'])->name('insertSubMenu');
Route::post('/Eliminar_SubMenu', [SubmenuController::class, 'Eliminar_SubMenu'])->name('EliminarSubMenu');
Route::post('/getSubMenu_Editar', [SubmenuController::class, 'getSubMenu_Editar'])->name('getSubMenuEditar');
Route::post('/insert_SubMenu_Editado', [SubmenuController::class, 'insert_SubMenu_Editado'])->name('insertSubMenuEditado');
//---------------------------------------------------------------------------------------------------------------
//----------------------------------| ImagenesController - TABLE "IMAGENES" ☠️ |-----------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::post('/get_Img', [ImagenesController::class, 'get_Img'])->name('getImg');
Route::post('/inret_IMGRoute', [ImagenesController::class, 'inret_IMGRoute'])->name('inretIMG');
//---------------------------------------------------------------------------------------------------------------
//-----------------------------------| URLController - RUTAS "URL" 👌 |------------------------------------------
//---------------------------------------------------------------------------------------------------------------
Route::get('/email_recuperacion', [URLController::class, 'email_recuperacion'])->name('email_recuperacion');
Route::get('/cambio_password/{fecha}', [URLController::class, 'cambio_password'])->name('cambio_password');
Route::get('/', [URLController::class, 'inicio_sesion'])->name('inicio_sesion'); 
Route::match(['get', 'post'], '/index/{token}', [URLController::class, 'index'])->name('index');
Route::match(['get', 'post'], '/home/{token}', [URLController::class, 'home'])->name('home');
Route::match(['get', 'post'], '/login_cambio_Pasword/{token}', [URLController::class, 'login_cambio_Pasword'])->name('login_cambio_Pasword');
Route::match(['get', 'post'], '/avatar/{token}', [URLController::class, 'avatar'])->name('Avatar');
//..--- MENU ---..
Route::match(['get', 'post'], '/informacion_personal/{token}', [URLController::class, 'informacion_personal'])->name('informacion_personal');
Route::match(['get', 'post'], '/permisos_economicos/{token}', [URLController::class, 'permisos_economicos'])->name('permisos_economicos');
Route::match(['get', 'post'], '/configuracion_de_roles/{token}', [URLController::class, 'configuracion_de_roles'])->name('configuracion_de_roles');
Route::match(['get', 'post'], '/panel_de_aprobacion/{token}', [URLController::class, 'panel_de_aprobacion'])->name('panel_de_aprobacion');
Route::match(['get', 'post'], '/mas_configuraciones_web/{token}', [URLController::class, 'mas_configuraciones_web'])->name('mas_configuraciones_web');




