<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('adminlogin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('adminlogout');
    Route::resource('/city','App\Http\Controllers\Admin\CityController')->middleware('isadmin');
    Route::resource('/category','App\Http\Controllers\Admin\CategoryController')->middleware('isadmin');
    Route::resource('/job','App\Http\Controllers\Admin\JobController')->middleware('isadmin');
    Route::resource('/user','App\Http\Controllers\Admin\UserController')->middleware('isadmin');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('isadmin')->name('adminDashboard');
});
