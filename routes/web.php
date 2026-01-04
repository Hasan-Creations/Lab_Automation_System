<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CpriController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\TestController;

// Login Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('batches', \App\Http\Controllers\Admin\BatchController::class);
    Route::post('/batches/{batch}/remake', [\App\Http\Controllers\Admin\BatchController::class, 'remake'])->name('batches.remake');
    Route::resource('cpri', CpriController::class);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/user', [SettingsController::class, 'store'])->name('settings.store');
    Route::put('/settings/user/{id}', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings/user/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    // Route::resource('test-types', \App\Http\Controllers\Admin\TestTypeController::class);
    Route::get('/requirements', [\App\Http\Controllers\Admin\ProductRequirementController::class, 'index'])->name('requirements.index');
    Route::post('/requirements', [\App\Http\Controllers\Admin\ProductRequirementController::class, 'store'])->name('requirements.store');
    Route::delete('/requirements/{id}', [\App\Http\Controllers\Admin\ProductRequirementController::class, 'destroy'])->name('requirements.destroy');
    Route::get('/search', [\App\Http\Controllers\User\SearchController::class, 'index'])->name('search');
    Route::get('/view-status', [App\Http\Controllers\User\StatusController::class, 'index'])->name('view-status');
});

// User Routes
Route::middleware(['auth', 'role:tester'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::resource('tests', TestController::class);
    Route::get('/search', [\App\Http\Controllers\User\SearchController::class, 'index'])->name('search');
    Route::get('/view-status', [\App\Http\Controllers\User\StatusController::class, 'index'])->name('view-status');
});
