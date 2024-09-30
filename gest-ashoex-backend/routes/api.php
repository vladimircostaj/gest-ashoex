<?php

use App\Http\Controllers\CarreraController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;

Route::get('/health', [HealthController::class, 'check']);

Route::controller(CarreraController::class)->group(function () {
    Route::get('/carreras', 'index');

});
