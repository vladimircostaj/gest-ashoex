<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalAcademicoController;

Route::post('/personal-academico', [PersonalAcademicoController::class, 'store']);
