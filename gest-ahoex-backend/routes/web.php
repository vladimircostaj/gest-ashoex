<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\CurriculaController;


/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::post('/curricula/update',[CurriculaController::class, 'update']);
