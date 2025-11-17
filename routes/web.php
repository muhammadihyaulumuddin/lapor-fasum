<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - CLEAN VERSION
|--------------------------------------------------------------------------
*/

// ==================== ROUTES USER ====================
Route::get('/', [ReportController::class, 'create'])->name('user.report.create');
Route::post('/report/store', [ReportController::class, 'store'])->name('user.report.store');

// ==================== ROUTES ADMIN ====================
Route::prefix('admin')->group(function () {
  // Login routes - TANPA MIDDLEWARE
  Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
  Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
  Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

  // Dashboard dan lainnya - TANPA MIDDLEWARE DULU
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/detail/{id}', [DashboardController::class, 'detail'])->name('admin.detail');
  Route::get('/update/{id}', [DashboardController::class, 'update'])->name('admin.update');
  Route::put('/update/{id}', [DashboardController::class, 'updateProcess'])->name('admin.update.process');
  Route::delete('/delete/{id}', [DashboardController::class, 'destroy'])->name('admin.delete');
});
