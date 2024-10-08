<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListaPersonalAcademicoController;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\PersonalAcademicoController;

Route::get('/health', [HealthController::class, 'check']);
Route::get('/personales', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
Route::post('/registrar-personal-academico', [PersonalAcademicoController::class, 'registrar']);
Route::get('/personal/{id}/informacion', [PersonalAcademicoController::class, 'show']);
