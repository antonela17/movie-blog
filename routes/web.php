<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;

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
    return view('index');
});

Route::get('/contact', [\App\Http\Controllers\ContactController::class,'create']);
Route::post('/contact',[\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

//Route::get('/blog', function () {
//    return view('blog');
//});

Route::get('/blog-details', function () {
    return view('blog-details');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/project-details', function () {
    return view('project-details');
});

Route::get('/projects', function () {
    return view('projects');
});

Route::get('/sample-inner-page', function () {
    return view('sample-inner-page');
});

Route::get('/service-details', function () {
    return view('service-details');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/email', function () {
  Mail::to('info@gmail.com')->send(new ContactEmail());
    return new ContactEmail();
});

Route::get('/blog',[\App\Http\Controllers\BlogController::class,'show']);
Route::post('/blog',[\App\Http\Controllers\BlogController::class,'search'])->name('search');

Route::get('/blog/{slug}', [\App\Http\Controllers\CategoryController::class,'show']);

Route::get('/{slug}',[\App\Http\Controllers\BlogDetailsController::class,'show']);




Route::get('/sendMail', [\App\Http\Controllers\MailController::class,'sendMail']);

Route::get('/json',[\App\Http\Controllers\readDataFromJson::class,'readData']);
