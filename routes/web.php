<?php

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes(['register' => false]);
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //student routes
    Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/data', [App\Http\Controllers\StudentController::class, 'data'])->name('students.data');
    Route::post('/students/store', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
    Route::post('/students/update/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');

    //student import route
    Route::post('/students/import', [App\Http\Controllers\StudentController::class, 'import'])->name('students.import');

    Route::get('/programmes/{department}', [App\Http\Controllers\StudentController::class, 'getProgrammes']);

    //staff routes
    Route::get('/staff', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/data', [App\Http\Controllers\StaffController::class, 'data'])->name('staff.data');
    Route::post('/staff/store', [App\Http\Controllers\StaffController::class, 'store'])->name('staff.store');
});
