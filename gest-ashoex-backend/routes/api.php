<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\CarreraController;

Route::get('/health', [HealthController::class, 'check']);
Route::get('/carreras', [CarreraController::class, 'index']);
Route::post('/carreras', [CarreraController::class, 'store']);