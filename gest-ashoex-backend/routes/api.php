<?php

use App\Http\Controllers\PersonalAcademicoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;

Route::get('/health', [HealthController::class, 'check']);

Route::put('/personal-academico/{id}', [PersonalAcademicoController::class,'update']);