<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;

Route::controller(CarreraController::class)->group(function (){
    Route::get('carreras', 'index');
    //Route::get('carreras/{id}', 'show');
    //Route::post('carreras', 'store');
    //Route::put('carreras/{id}', 'update');
    //Route::delete('carreras/{id}', 'destroy');
});

/*
Route::get('/', function () {
    return view('welcome');
});*/
