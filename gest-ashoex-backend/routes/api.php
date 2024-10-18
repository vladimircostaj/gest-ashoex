<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
	HealthController,
	PersonalAcademicoController,
    ListaPersonalAcademicoController
};

use App\Http\Middleware\Sanitizer;

Route::get('/health', [HealthController::class, 'check']);

Route::controller(PersonalAcademicoController::class)->group(function () {
	Route::get('/personal-academicos', 'index');
    Route::get('/personal-academicos/{id}',  'show');

    Route::post('/personal-academico', 'registrar');

    Route::put('/personal-academico/{id}','update');
        
	Route::patch('/personalAcademicos/{id}/dar-baja', 'darDeBaja');
})->middleware(Sanitizer::class);

Route::get('/ListaPersonalAcademico', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
