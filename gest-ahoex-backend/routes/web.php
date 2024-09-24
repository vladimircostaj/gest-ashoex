<?php
use App\Http\Controllers\PersonalAcademicoController;

use Illuminate\Support\Facades\Route;

Route::get('/api/ListaPersonalAcademico', [PersonalAcademicoController::class, 'ListaPersonalAcademico']);
