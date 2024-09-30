<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
	HealthController,
	PersonalAcademicoController
};

use App\Http\Middleware\Sanitizer;

Route::get('/health', [HealthController::class, 'check']);

Route::controller(PersonalAcademicoController::class)->group(function () {
	Route::get('/personal-academicos/{id}', 'index');
	
	Route::patch('/personal-academicos/dar-baja', 'darDeBaja')
		->middleware(Sanitizer::class);
});