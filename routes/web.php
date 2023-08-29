<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ScriptureController;
use App\Http\Controllers\GradeCourseController;
use App\Http\Controllers\StudentResultController;
use App\Http\Controllers\LearningCenterController;
use App\Http\Controllers\PaceRequestMarksController;
use App\Http\Controllers\AssignGradeTeacherController;
use App\Http\Controllers\FileUploadController;

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
    Route::resource('/student', StudentController::class);
    Route::get('/alumini', [StudentController::class, 'alumini'])->name('student.alumini');

    // suppliers
    Route::resource('/supplier', SupplierController::class);
    // courses
    Route::resource('/subject', CourseController::class);
    // courses
    Route::resource('/grade', GradeCourseController::class);


    // learning center
    Route::resource('/learning_center', LearningCenterController::class)->names('learning');
    Route::put('/disable_learning_center{id}', [LearningCenterController::class, 'disable'])->name('learning.disable');
    Route::patch('/assigngradetolearningcenter', [LearningCenterController::class, 'assignGrade'])->name('assignGradeToLC');

    // users routes
    Route::resource('/users', UserController::class)->names('user');
    Route::patch('/disableorenableuser{id}', [UserController::class, 'disableEnable'])->name("user.disableEnable");
    Route::patch('/resetPassword{id}', [UserController::class, 'resetPassword'])->name("user.resetPassword");
    Route::get('/setting', [UserController::class, 'accountSetting'])->name("user.accountSetting");

    // suppervisor routes
    Route::resource("/assign/LC", AssignGradeTeacherController::class)->names("assign");

    // pace request & marks
    Route::get('/pace/requests', [PaceRequestMarksController::class, "index"])->name('pace.requests.marks');
    Route::get('/pace/students/progress', [PaceRequestMarksController::class, "studentProgress"])->name('pace.student.progress');

    //scriptures
    Route::resource("/greade/scriptures", ScriptureController::class)->names('scripture');

    // student results
    Route::get('results/studentCard', [StudentResultController::class, "results"])->name('student.results');
    Route::post('student/profile', [StudentResultController::class, "profile"])->name('student.profile');
    Route::get('results/inGrades', [StudentResultController::class, "getStudents"])->name('student.ingrade');
    Route::get('/grad', [GradController::class, 'index'])->name('grad.index');
    Route::get('/paceview{id}', [GradController::class, 'viewpace'])->name('pace.viewpace');

    Route::post('profile/upload', [FileUploadController::class,'uploadProfilePicture'])->name('student.profilePicture');
    
});
