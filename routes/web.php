<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');
Route::get('/home2', function () {
    return view('index2');
})->name('index2');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/add-resume', function () {
    return view('add-resume');
})->name('add-resume');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/blog-fuul-width', function () {
    return view('blog-full-width');
})->name('blog-full-width');
Route::get('/blog-left-sidebar', function () {
    return view('blog-left-sidebar');
})->name('blog-left-sidebar');
Route::get('/bookmarked', function () {
    return view('bookmarked');
})->name('bookmarked');
Route::get('/browse-categories', function () {
    return view('browse-categories');
})->name('browse-categories');
Route::get('/browse-jobs', function () {
    return view('browse-jobs');
})->name('browse-jobs');
Route::get('/browse-resumes', function () {
    return view('browse-resumes');
})->name('browse-resumes');
Route::get('/change-password', function () {
    return view('change-password');
})->name('change-password');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/job-alerts', function () {
    return view('job-alerts');
})->name('job-alerts');
Route::get('/job-details', function () {
    return view('job-details');
})->name('job-details');
Route::get('/job-page', function () {
    return view('job-page');
})->name('job-page');
Route::get('/manage-applications', function () {
    return view('manage-applications');
})->name('manage-applications');
Route::get('/manage-jobs', function () {
    return view('manage-jobs');
})->name('manage-jobs');
Route::get('/manage-resumes', function () {
    return view('manage-resumes');
})->name('manage-resumes');
Route::get('/notifications', function () {
    return view('notifications');
})->name('notifications');
Route::get('/post-job', function () {
    return view('post-job');
})->name('post-job');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');
Route::get('/resume', function () {
    return view('resume');
})->name('resume');
Route::get('/single-post', function () {
    return view('single-post');
})->name('single-post');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/reg', function () {
    return view('register');
})->name('reg');
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
