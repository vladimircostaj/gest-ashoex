<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ambiente\AmbienteController;


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
});

// Route::apiResource('/ambiente', App\Http\Controllers\Ambiente\AmbienteController::class);