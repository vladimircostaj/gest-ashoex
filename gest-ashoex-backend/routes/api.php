<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListaPersonalAcademicoController;

use App\Http\Controllers\HealthController;
Route::get('/health', [HealthController::class, 'check']);
Route::get('/ListaPersonalAcademico', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
Route::get('/ListaPersonalAcademico', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
