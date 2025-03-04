<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginSedeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

Route::post('/login-sede', [LoginSedeController::class, 'login']);

Route::post('/register-sede', [LoginSedeController::class, 'register']);

Route::get('/usuariosede',[LoginSedeController::class, 'index']);
Route::get('/show-sede/{numero_sede}', [LoginSedeController::class, 'show']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::resource('/sede', SedeController::class)->except(['show', 'update', 'destroy']);
Route::get('/sede/{nombre_sede}', [SedeController::class, 'show']);
Route::put('/sede/{id}', [SedeController::class, 'update']);
Route::delete('/sede/{id}', [SedeController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    // Ruta protegidas Usuarios
    Route::resource('/usuario', UsuarioController::class)->except(['show', 'update', 'destroy']);
    Route::get('/usuario/{identificacion}', [UsuarioController::class, 'show']);
    Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);

    // Rutas protegidas Roles
    Route::resource('/rol', RolController::class)->except(['update', 'destroy']);
    Route::put('/rol/{id}', [RolController::class, 'update']);
    Route::delete('/rol/{id}', [RolController::class, 'destroy']);

    // Rutas protegidas Fichas
    Route::resource('/ficha', FichaController::class)->except(['show', 'update', 'destroy']);
    Route::get('/ficha/{numero_ficha}', [FichaController::class, 'show']);
    Route::put('/ficha/{id}', [FichaController::class, 'update']);
    Route::delete('/ficha/{id}', [FichaController::class, 'destroy']);

    // Rutas protegidas Herramientas
    Route::resource('/herramienta', HerramientaController::class)->except(['show', 'update', 'destroy']);
    Route::get('/herramienta/{codigo}', [HerramientaController::class, 'show']);
    Route::put('/herramienta/{id}', [HerramientaController::class, 'update']);
    Route::delete('/herramienta/{id}', [HerramientaController::class, 'destroy']);

    //Rutas protegidas  Ambientes
    Route::resource('/ambiente', AmbienteController::class)->except(['show', 'update', 'destroy']);
    Route::get('/ambiente/{codigo}', [AmbienteController::class, 'show']);
    Route::put('/ambiente/{id}', [AmbienteController::class, 'update']);
    Route::delete('/ambiente/{id}', [AmbienteController::class, 'destroy']);

    //Rutas protegidas  Préstamos
    Route::resource('/prestamo', PrestamoController::class)->except(['show', 'update', 'destroy']);
    Route::get('/prestamo/{identificacion}', [PrestamoController::class, 'show']);
    Route::put('/prestamo/{id}', [PrestamoController::class, 'update']);
    Route::delete('/prestamo/{id}', [PrestamoController::class, 'destroy']);

    //Rutas protegidas Historial
    Route::resource('/historial', HistorialController::class)->except(['show']);
    Route::get('/historial/{id}', [HistorialController::class, 'show']);

    //Rutas protegidas UsuarioSedes
    Route::put('/usuariosede/{id}', [LoginSedeController::class, 'update']);
    Route::delete('/usuariosede/{id}', [LoginSedeController::class, 'destroy']);
    // Logout (cerrar sesión)
    Route::post('/logout', [LoginSedeController::class, 'logout']);
});
