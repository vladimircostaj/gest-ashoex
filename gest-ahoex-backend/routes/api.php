<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalAcademicoController;

Route::put('/personal-academico/{id}', [PersonalAcademicoController::class, 'update']);
