<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ambiente\AmbienteController;
use App\Http\Controllers\Edificio\EdificioController;
use App\Http\Controllers\Ubicacion\UbicacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

Route::prefix('api')->group(function () {
    Route::get('/ambiente', [AmbienteController::class, 'index']);
    Route::post('/ambiente', [AmbienteController::class, 'store']);
    Route::get('/ambiente/{id}', [AmbienteController::class, 'show']);
    Route::put('/ambiente/{id}', [AmbienteController::class, 'update']);
    Route::delete('/ambiente/{id}', [AmbienteController::class, 'destroy']);
    Route::get('/ubicacion', [UbicacionController::class, 'index']);
    Route::post('/ubicacion', [UbicacionController::class, 'store']);
    Route::get('/ubicacion/{id}', [UbicacionController::class, 'show']);
    Route::put('/ubicacion/{id}', [UbicacionController::class, 'update']);
    Route::delete('/ubicacion/{id}', [UbicacionController::class, 'destroy']);
    Route::get('/edificio', [EdificioController::class, 'index']);
    Route::post('/edificio', [EdificioController::class, 'store']);
});

// Route::apiResource('/ambiente', App\Http\Controllers\Ambiente\AmbienteController::class);
