<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\GrupoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\CurriculaController;
use App\Http\Controllers\MateriaController;
//use App\Models\Carrera;


Route::get('/health', [HealthController::class, 'check']);

Route::controller(CarreraController::class)->group(function () {
    Route::get('/carreras', 'index');
    Route::get('/carreras/{id}', 'show');

    Route::delete('/carreras/{id}', 'destroy');
    Route::post('/carreras', 'store');
    Route::put('/carreras/{id}', 'update');
});

Route::controller(CurriculaController::class)->group(function () {
    Route::get('/curriculas', 'index');
    Route::get('/curriculas/{id}', 'show');
    Route::put('/curriculas/{id}', 'update');
    Route::post('/curriculas', 'store');
    Route::delete('/curriculas/{id}', 'destroy');
});

Route::controller(MateriaController::class)->group(function () {
    Route::get('/materias', 'index');
    Route::post('/materias', 'store');
    Route::get('/materias/{id}', 'show');
    Route::put('/materias/{id}', 'update'); // Ruta para actualizar materia 
    Route::patch('/materias/{id}', 'update'); // Ruta para actualización parcial
    Route::delete('/materias/{id}', 'destroy');
});

Route::controller(GrupoController::class)->group(function () {
    Route::get('/grupos', 'index');
    Route::post('/grupos', 'store');
    Route::get('/grupos/{id}', 'show');
    Route::put('/grupos/{id}', 'update');
    Route::delete('/grupos/{id}', 'destroy');
});
