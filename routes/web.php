<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController      as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseController    as AdminCourseController;
use App\Http\Controllers\Admin\QuizController      as AdminQuizController;
use App\Http\Controllers\Admin\UserController      as AdminUserController;
use App\Http\Controllers\Admin\ResultController    as AdminResultController;
use App\Http\Controllers\User\AuthController       as UserAuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\CourseController;

// ── Root redirect ────────────────────────────────────────────────────────────
Route::get('/', fn () => redirect()->route('login'));

// User authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
});

// Protected user area
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/course/{id}', [CourseController::class, 'index'])->name('course');
    Route::get('/quiz/preview/{id}', [CourseController::class, 'quizPreview'])->name('quiz.preview');

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

// ── Admin area ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Public admin auth routes
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Courses
        Route::resource('courses', AdminCourseController::class);
        Route::post('/courses/{course}/toggle-publish', [AdminCourseController::class, 'togglePublish'])
             ->name('courses.toggle-publish');

        // Quizzes
        Route::resource('quizzes', AdminQuizController::class);

        // Users
        Route::resource('users', AdminUserController::class)->only(['index', 'show', 'destroy']);

        // Results
        Route::get('/results',       [AdminResultController::class, 'index'])->name('results.index');
        Route::get('/results/{attempt}', [AdminResultController::class, 'show'])->name('results.show');

        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
