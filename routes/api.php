<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// location routes

Route::controller(LocationController::class)
    ->prefix('location')
    ->group(function () {
        // locations
        Route::get('/provinces', 'getProvinces')->name('location.getProvinces');
        Route::get('/district/{id}', 'getDistricts')->name('location.getDistricts');
        Route::get('/sectors/{id}', 'getSectors')->name('location.getSectors');
        Route::get('/cells/{id}', 'getCells')->name('location.getCells');
        Route::get('/villages/{id}', 'getVillages')->name('location.getVillages');
    });
