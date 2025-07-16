<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Открытые для всех авторизованных (ученик, автор, админ)
    Route::resource('courses', \App\Http\Controllers\CourseController::class)->only(['index','show']);
    Route::resource('modules', \App\Http\Controllers\ModuleController::class)->only(['show']);
    Route::resource('lessons', \App\Http\Controllers\LessonController::class)->only(['show']);

    // Только для авторов и админов
    Route::middleware('role:author,admin')->group(function () {
        Route::resource('courses', \App\Http\Controllers\CourseController::class)->except(['index','show']);
        Route::resource('modules', \App\Http\Controllers\ModuleController::class)->except(['show']);
        Route::resource('lessons', \App\Http\Controllers\LessonController::class)->except(['show']);
    });

    // Доступ ученика
    Route::resource('enrollments', \App\Http\Controllers\EnrollmentController::class)->only(['index','store','destroy']);
    Route::resource('comments', \App\Http\Controllers\CommentController::class)->only(['store','update','destroy']);
});

require __DIR__.'/auth.php';
