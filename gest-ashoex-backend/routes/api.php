<?php

use App\Http\Controllers\AulaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\FacilidadController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UsoController;

Route::get('/health', [HealthController::class, 'check']);



Route::get('/edificios', [EdificioController::class, 'index']);
Route::get('/edificios/{id}', [EdificioController::class, 'show']);
Route::post('/edificios', [EdificioController::class, 'store']);
Route::put('/edificios/{id}', [EdificioController::class, 'update']);
Route::delete('/edificios/{id}', [EdificioController::class, 'destroy']);

Route::get('/ubicaciones', [UbicacionController::class, 'index']);
Route::get('/ubicaciones/{id}', [UbicacionController::class, 'show']);
Route::post('/ubicaciones', [UbicacionController::class, 'store']);
Route::put('/ubicaciones/{id}', [UbicacionController::class, 'update']);
Route::delete('/ubicaciones/{id}', [UbicacionController::class, 'destroy']);

Route::get('/aulas', [AulaController::class, 'index']);
Route::get('/aulas/{id}', [AulaController::class, 'show']);
Route::post('/aulas', [AulaController::class, 'store']);
Route::put('/aulas/{id}', [AulaController::class, 'update']);
Route::delete('/aulas/{id}', [AulaController::class, 'destroy']);


Route::get('/usos', [UsoController::class, 'index']);
Route::get('/usos/{id}', [UsoController::class, 'show']);
Route::post('/usos', [UsoController::class, 'store']);
Route::put('/usos/{id}', [UsoController::class, 'update']);
Route::delete('/usos/{id}', [UsoController::class, 'destroy']);

Route::get('/facilidades', [FacilidadController::class, 'index']);
Route::get('/facilidades/{id}', [FacilidadController::class, 'show']);
Route::post('/facilidades', [FacilidadController::class, 'store']);
Route::put('/facilidades/{id}', [FacilidadController::class, 'update']);
Route::delete('/facilidades/{id}', [FacilidadController::class, 'destroy']);