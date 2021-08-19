<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\UserController;




Route::prefix('admin')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('adminlogin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('adminlogout');
    Route::resource('/city',CityController::class)->middleware('isadmin');
    Route::resource('/category',CategoryController::class)->middleware('isadmin');
    Route::resource('/job',JobController::class)->middleware('isadmin');
    Route::resource('/user',UserController::class)->middleware('isadmin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('isadmin')->name('adminDashboard');
});
