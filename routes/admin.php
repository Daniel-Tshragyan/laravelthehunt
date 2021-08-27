<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TagController;




Route::prefix('admin')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->middleware('notAdmin')->name('adminloginpage');
    Route::post('/login', [AuthController::class, 'login'])->name('adminlogin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('adminlogout');
    Route::resource('/city',CityController::class)->middleware(['isadmin','trim']);
    Route::resource('/category',CategoryController::class)->middleware(['isadmin','trim']);
    Route::resource('/job',JobController::class)->middleware(['isadmin','trim']);
    Route::resource('/user',UserController::class)->middleware(['isadmin','trim']);
    Route::resource('/tag',TagController::class)->middleware(['isadmin','trim']);
    Route::resource('/plan',PlanController::class)->middleware(['isadmin','trim']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('isadmin')->name('adminDashboard');
});
