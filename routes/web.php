<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\OrdenesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::get('/estadisticas', [App\Http\Controllers\HomeController::class, 'estadisticas'])->name('estadisticas');
Route::get('/perfiles', [App\Http\Controllers\HomeController::class, 'perfiles'])->name('perfiles');

//ENRUTAMIENTO DE FUNCIONALIDADES PARA EL MÓDULO PROVEEDORES
Route::get('/proveedores', [ProveedorController::class, 'proveedores'])->name('proveedores');
Route::post('/registrar_proveedor', [ProveedorController::class, 'registrar_proveedor'])->name('registrar_proveedor');
Route::post('/actualizar_proveedor', [ProveedorController::class, 'actualizar_proveedor'])->name('actualizar_proveedor');
Route::post('/habilitacion_proveedor', [ProveedorController::class, 'habilitacion_proveedor'])->name('habilitacion_proveedor');
Route::post('/inhabilitacion_proveedor', [ProveedorController::class, 'inhabilitacion_proveedor'])->name('inhabilitacion_proveedor');

//ENRUTAMIENTO DE FUNCIONALIDADES PARA EL MÓDULO USUARIO
Route::post('registrar_usuario', [UsersController::class, 'registrar_usuario'])->name('registrar_usuario');
Route::get('usuarios', [UsersController::class, 'usuarios'])->name('usuarios');
Route::post('actualizar_usuario', [UsersController::class, 'actualizar_usuario'])->name('actualizar_usuario');
Route::get('contrasena', [HomeController::class, 'contrasena'])->name('contrasena')->name('contrasena');
Route::post('restablecer_contrasena', [UsersController::class, 'restablecer_contrasena'])->name('restablecer_contrasena');
Route::get('perfil', [UsersController::class, 'consulta_usuario_especifico'])->name('consulta_usuario_especifico');
Route::get('usuario_especifico/{id}', [UsersController::class, 'usuario_especifico'])->name('usuario_especifico');
Route::post('actualizar_usuario_especifico', [UsersController::class, 'actualizar_usuario_especifico'])->name('actualizar_usuario_especifico');

//ENRUTAMIENTO DE FUNCIONALIDADES PARA EL MÓDULO MEDICAMENTOS
Route::get('/medicamentos', [MedicamentosController::class, 'medicamentos'])->name('medicamentos');
Route::post('/registrar_medicamento', [MedicamentosController::class, 'registrar_medicamento'])->name('registrar_medicamento');
Route::post('/actualizar_medicamento', [MedicamentosController::class, 'actualizar_medicamento'])->name('actualizar_medicamento');
Route::post('/habilitacion_medicamento', [MedicamentosController::class, 'habilitacion_medicamento'])->name('habilitacion_medicamento');
Route::post('/inhabilitacion_medicamento', [MedicamentosController::class, 'inhabilitacion_medicamento'])->name('inhabilitacion_medicamento');

//ENRUTAMIENTO DE FUNCIONALIDADES PARA EL MÓDULO PROVEEDORES
Route::get('/ordenes', [OrdenesController::class, 'ordenes'])->name('ordenes');
Route::post('/registrar_orden', [OrdenesController::class, 'registrar_orden'])->name('registrar_orden');