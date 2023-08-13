<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// guest middlewared routes
Route::middleware('guest')->group(function () {
    Route::view('/', 'auth.login');
});

// authentication routes
Auth::routes();

// authenticated routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // student routes
    Route::resource('student', StudentController::class);
    Route::get('/alumini', [StudentController::class, 'alumini'])->name('student.alumini');
});
