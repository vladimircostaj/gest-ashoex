<?php

use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CarreraController;
//use App\Http\Controllers\CarreraController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
//use App\Models\Carrera;

Route::get('/health', [HealthController::class, 'check']);

//rutas grupo
Route::get('/grupoIndex',[GrupoController::class,'index']);

Route::get('/carreraIndex',[CarreraController::class,'index']);


