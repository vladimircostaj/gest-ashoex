<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\PersonalAcademicoController;

Route::get('/health', [HealthController::class, 'check']);

Route::post('/registrar-personal-academico', [PersonalAcademicoController::class, 'registrar']);