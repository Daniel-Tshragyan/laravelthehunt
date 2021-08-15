<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('viewarchive.welcome');
})->name('home');

Route::get('/home', function () {
    return view('viewarchive.welcome');
})->name('home');
Route::get('/home2', function () {
    return view('viewarchive.index2');
})->name('index2');
Route::get('/about', function () {
    return view('viewarchive.about');
})->name('about');
Route::get('/add-resume', function () {
    return view('viewarchive.add-resume');
})->name('add-resume');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/blog-fuul-width', function () {
    return view('viewarchive.blog-full-width');
})->name('blog-full-width');
Route::get('/blog-left-sidebar', function () {
    return view('viewarchive.blog-left-sidebar');
})->name('blog-left-sidebar');
Route::get('/bookmarked', function () {
    return view('viewarchive.bookmarked');
})->name('bookmarked');
Route::get('/browse-categories', function () {
    return view('viewarchive.browse-categories');
})->name('browse-categories');
Route::get('/browse-jobs', function () {
    return view('viewarchive.browse-jobs');
})->name('browse-jobs');
Route::get('/browse-resumes', function () {
    return view('viewarchive.browse-resumes');
})->name('browse-resumes');
Route::get('/change-password', function () {
    return view('viewarchive.change-password');
})->name('change-password');
Route::get('/contact', function () {
    return view('viewarchive.contact');
})->name('contact');
Route::get('/faq', function () {
    return view('viewarchive.faq');
})->name('faq');
Route::get('/job-alerts', function () {
    return view('viewarchive.job-alerts');
})->name('job-alerts');
Route::get('/job-details', function () {
    return view('viewarchive.job-details');
})->name('job-details');
Route::get('/job-page', function () {
    return view('viewarchive.job-page');
})->name('job-page');
Route::get('/manage-applications', function () {
    return view('viewarchive.manage-applications');
})->name('manage-applications');
Route::get('/manage-jobs', function () {
    return view('viewarchive.manage-jobs');
})->name('manage-jobs');
Route::get('/manage-resumes', function () {
    return view('viewarchive.manage-resumes');
})->name('manage-resumes');
Route::get('/notifications', function () {
    return view('viewarchive.notifications');
})->name('notifications');
Route::get('/post-job', function () {
    return view('viewarchive.post-job');
})->name('post-job');
Route::get('/privacy-policy', function () {
    return view('viewarchive.privacy-policy');
})->name('privacy-policy');
Route::get('/resume', function () {
    return view('viewarchive.resume');
})->name('resume');
Route::get('/single-post', function () {
    return view('viewarchive.single-post');
})->name('single-post');
Route::get('/log', function () {
    return view('viewarchive.login');
})->name('login1');
Route::get('/reg', [UserController::class, 'candidatreg'])->name('reg');
Route::get('/regcompany', [UserController::class, 'companyreg'])->name('reg1');
Route::get('/pricing', function () {
    return view('viewarchive.pricing');
})->name('pricing');



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
