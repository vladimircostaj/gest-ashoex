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
	Route::get('/personal-academicos/{id}', 'index');
    Route::get('/personal/{id}/informacion',  'show');

    Route::post('/registrar-personal-academico', 'registrar');

    Route::put('/personal-academico/{id}','update');
        
	Route::patch('/personal-academicos/dar-baja', 'darDeBaja')
        ->middleware(Sanitizer::class);
});

Route::get('/ListaPersonalAcademico', [ListaPersonalAcademicoController::class, 'ListaPersonalAcademico']);
