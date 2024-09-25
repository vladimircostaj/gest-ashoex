<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\CurriculaController;


/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::post('/curricula/update',[CurriculaController::class, 'update']);
Route::post('/curricula/eliminar',[CurriculaController::class, 'destroy']);

