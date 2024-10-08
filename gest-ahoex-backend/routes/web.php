<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\CurriculaController;


/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::delete('/curricula/eliminar',[CurriculaController::class, 'destroy']);