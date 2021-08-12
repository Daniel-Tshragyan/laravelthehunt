<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('login', [AdminController::class, 'login'])->name('adminlogin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('isadmin')->name('adminDashboard');
});
