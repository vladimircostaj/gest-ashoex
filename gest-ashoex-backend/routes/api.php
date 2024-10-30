<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HealthController;
use App\Http\Controllers\PersonalAcademicoController;


Route::get('/health', [HealthController::class, 'check']);

Route::controller(PersonalAcademicoController::class)->group(function () {
    Route::get('/personal-academicos', 'ListaPersonalAcademico');
    Route::get('/personal-academicos/{id}',  'show');
    Route::post('/personal-academico', 'registrar');
    Route::put('/personal-academico/{id}','update');
	Route::patch('/personal-academicos/{id}/dar-baja', 'darDeBaja');
});
