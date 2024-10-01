<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\GrupoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\CurriculaController; 
//use App\Models\Carrera;

Route::get('/health', [HealthController::class, 'check']);

Route::controller(CarreraController::class)->group(function () {
    Route::get('/carreras', 'index');
    Route::delete('/carreras/{id}','destroy');
});

Route::controller(CurriculaController::class)->group(function () {
    Route::get('/curriculas', 'index');
    Route::get('/curriculas/{id}', 'show');
    Route::post('/curriculas', 'store');

});

Route::get('/grupo',[GrupoController::class,'index']);
Route::post('/grupo',[GrupoController::class,'store']);
Route::get('/grupo/{id}',[GrupoController::class,'show']);
Route::put('/grupo/{id}',[GrupoController::class,'update']);
Route::delete('/grupo/{id}',[GrupoController::class,'destroy']);

