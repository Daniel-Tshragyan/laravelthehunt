<?php

use App\Http\Controllers\FrontEnd\Company\ApplicationController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontEnd\Company\JobController;
use App\Http\Controllers\FrontEnd\Candidate\JobController as CandidateJob;

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
    return view('frontend.home.welcome');
})->name('home');

Route::get('/home', function () {
    return view('frontend.home.welcome');
})->name('home');
Route::get('/home2', function () {
    return view('frontend.home.index2');
})->name('index2');
Route::get('/about', function () {
    return view('frontend.main.about');
})->name('about');
Route::get('/add-resume', function () {
    return view('frontend.candidate.resume.add-resume');
})->name('add-resume');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');
Route::get('/blog-fuul-width', function () {
    return view('frontend.blog.blog-full-width');
})->name('blog-full-width');
Route::get('/blog-left-sidebar', function () {
    return view('frontend.blog.blog-left-sidebar');
})->name('blog-left-sidebar');
Route::get('/bookmarked', function () {
    return view('frontend.company.job.bookmarked');
})->name('bookmarked');
Route::get('/browse-categories', function () {
    return view('frontend.category.browse-categories');
})->name('browse-categories');

Route::get('/browse-resumes', function () {
    return view('frontend.candidate.resume.add-resume');
})->name('browse-resumes');
Route::get('/change-password', function () {
    return view('auth.change-password');
})->name('change-password');
Route::get('/contact', function () {
    return view('frontend.main.contact');
})->name('contact');
Route::get('/faq', function () {
    return view('frontend.main.faq');
})->name('faq');
Route::get('/job-alerts', function () {
    return view('frontend.candidate.job.job-alerts');
})->name('job-alerts');
Route::get('/job-page', function () {
    return view('frontend.candidate.job.job-page');
})->name('job-page')->middleware(['auth', 'IsCandidate']);


Route::get('/manage-resumes', function () {
    return view('frontend.candidate.resume.manage-resumes');
})->name('manage-resumes')->middleware(['auth', 'IsCandidate']);
Route::get('/notifications', function () {
    return view('frontend.candidate.notifications.notifications');
})->name('notifications');

Route::get('/privacy-policy', function () {
    return view('frontend.main.privacy-policy');
})->name('privacy-policy');
Route::get('/resume', function () {
    return view('frontend.candidate.resume.resume');
})->name('resume');
Route::get('/single-post', function () {
    return view('frontend.blog.single-post');
})->name('single-post');
Route::get('/log', function () {
    return view('auth.login');
})->name('login1');
Route::get('/reg', [UserController::class, 'candidateReg'])->name('reg');
Route::get('/reg-company', [UserController::class, 'companyReg'])->name('reg1');
Route::get('/pricing', function () {
    return view('frontend.main.pricing');
})->name('pricing');

//_____________________________________________________________________________

Route::get('/browse-jobs', [CandidateJob::class, 'index'])->name('browse-jobs');
Route::get('/show-job/{id}', [CandidateJob::class, 'show'])->name('show-job');
Route::post('/apply-job/{id}', [CandidateJob::class, 'applyJob'])->middleware(['auth', 'isCandidate'])->name('apply-job');
Route::get('/manage-applications', [ApplicationController::class, 'index'])->middleware(['auth', 'isCompany'])->name('manage-applications');
Route::resource('/front-job', JobController::class)->middleware(['auth', 'isCompany']);


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
