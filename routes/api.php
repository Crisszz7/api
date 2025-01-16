<?php

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\Auth\LoginSedeController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PrestamoController;
use App\Models\Ambiente;
use App\Models\Historial;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//Ruta para proteger paginas cuando el usuario no este logeado, no necesario
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route definition for resourceful routes for UsuarioController
Route::resource('/usuario', UsuarioController::class)->except(['show', 'update', 'destroy']);
Route::get('/usuario/{identificacion}', [UsuarioController::class, 'show']);
Route::put('/usuario/{identificacion}', [UsuarioController::class, 'update']);
Route::delete('/usuario/{identificacion}', [UsuarioController::class, 'destroy']);
//Route de Roles
Route::resource('/rol', RolController::class);
//Route de Fichas
Route::resource('/ficha', FichaController::class)->except('show', 'update', 'destroy');
Route::get('/ficha/{numero_ficha}', [FichaController::class, 'show']);
Route::put('/ficha/{numero_ficha}', [FichaController::class, 'update']);
Route::delete('/ficha/{numero_ficha}', [FichaController::class, 'destroy']);
//Route de Herramientas
Route::resource('/herramienta', HerramientaController::class)->except('show', 'update', 'destroy');
Route::get('/herramienta/{codigo}', [HerramientaController::class, 'show']);
Route::put('/herramienta/{codigo}', [HerramientaController::class, 'update']);
Route::delete('/herramienta/{codigo}', [HerramientaController::class, 'destroy']);

Route::resource('/sede', SedeController::class)->except('show', 'update', 'destroy');
Route::get('/sede/{nombre_sede}', [SedeController::class, 'show']);
Route::put('/sede/{nombre_sede}', [SedeController::class, 'update']);
Route::delete('/sede/{nombre_sede}', [SedeController::class, 'destroy']);

Route::resource('/ambiente', AmbienteController::class)->except('show', 'update', 'destroy');
Route::get('/ambiente/{codigo}', [AmbienteController::class, 'show']);
Route::put('/ambiente/{codigo}', [AmbienteController::class, 'update']);
Route::delete('/ambiente/{codigo}', [AmbienteController::class, 'destroy']);

Route::resource('/prestamo', PrestamoController::class)->except('show', 'update', 'destroy');
Route::get('/prestamo/{identificacion}', [PrestamoController::class, 'show']);
Route::put('/prestamo/{identificacion}', [PrestamoController::class, 'update']);
Route::delete('/prestamo/{identificacion}', [PrestamoController::class, 'destroy']);

Route::resource('/historial', HistorialController::class)->except('show');
Route::get('/historial/{identificacion}', [HistorialController::class, 'show']);

Route::post('login-sede', [LoginSedeController::class, 'login']);
Route::post('register-sede', [LoginSedeController::class, 'register']); 

