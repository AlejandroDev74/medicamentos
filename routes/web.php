<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/usuarios', [App\Http\Controllers\HomeController::class, 'usuarios'])->name('usuarios');
Route::get('/medicamentos', [App\Http\Controllers\HomeController::class, 'medicamentos'])->name('medicamentos');
Route::get('/perfiles', [App\Http\Controllers\HomeController::class, 'perfiles'])->name('perfiles');
Route::get('/proveedores', [App\Http\Controllers\HomeController::class, 'proveedores'])->name('proveedores');
