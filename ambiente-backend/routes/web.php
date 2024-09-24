<?php

use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(BuildingController::class)->group(function () {
    Route::get('/edificios', 'index');

    Route::post('/edificio', 'store');
});
