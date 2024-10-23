<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
	HealthController,
	PersonalAcademicoController,
    ListaPersonalAcademicoController
};

Route::get('/health', [HealthController::class, 'check']);

Route::controller(PersonalAcademicoController::class)->group(function () {
	Route::get('/personal-academicos', 'index');
    Route::get('/personal-academicos/{id}',  'show');
    Route::post('/personal-academico', 'registrar');
    Route::put('/personal-academico/{id}','update');
	Route::patch('/personal-academicos/dar-baja', 'darDeBaja');
});

Route::get('/ListaPersonalAcademico', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
