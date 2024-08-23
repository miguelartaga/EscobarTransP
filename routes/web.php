<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CamionesController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ChofereController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\TipoMantenimientoController;
use App\Http\Controllers\RutaController;

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Asegura todas las rutas con middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::resource('/camiones', CamionesController::class);
    Route::resource('/lugares', LugarController::class);
    Route::resource('/destinos', DestinoController::class);
    Route::resource('/choferes', ChofereController::class);
    Route::resource('/mantenimientos', MantenimientoController::class);
    Route::resource('/tipo-mantenimientos', TipoMantenimientoController::class);

    Route::post('/rutas/generate-invoice', [RutaController::class, 'generateInvoice'])->name('rutas.generateInvoice');
    Route::resource('/rutas', RutaController::class);
    Route::patch('/rutas/{id}/updateStatus', [RutaController::class, 'updateStatus'])->name('rutas.updateStatus');
});
