<?php

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'user_only'], function () {

    Route::get('/home', [\App\Http\Controllers\HomePageController::class, 'show']);

    Route::get('/home/contact', [\App\Http\Controllers\ContactController::class, 'create']);
    Route::post('/home/contact', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

    Route::get('/home/about', function () {
        return view('about');
    });

    Route::get('/home/project-details', function () {
        return view('project-details');
    });

    Route::get('/home/projects', function () {
        return view('projects');
    });

    Route::get('/home/sample-inner-page', function () {
        return view('sample-inner-page');
    });

    Route::get('/home/service-details', function () {
        return view('service-details');
    });

    Route::get('/home/services', function () {
        return view('services');
    });

//Route::get('/home/email', function () {
//  Mail::to('info@gmail.com')->send(new ContactEmail());
//    return new ContactEmail();
//});

    Route::get('/home/movies', [\App\Http\Controllers\MoviesController::class, 'show']);
    Route::post('/home/movies', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

    Route::group(['middleware' => 'admin_only'], function () {
        Route::get('/home/movies/create', [\App\Http\Controllers\MoviesController::class, "showCreateMovie"])->name('movie.showCreate');
        Route::post("/home/movies/create", [\App\Http\Controllers\MoviesController::class, 'createMovie'])->name('movie.create');
        Route::post('/home/delete/{id}', [\App\Http\Controllers\MoviesController::class, 'destroy'])->name('movie.delete');
        Route::get('/home/movies/edit/{id}', [\App\Http\Controllers\MoviesController::class, "showEditPage"])->name('movie.showEdit');
        Route::post('/home/movies/edit/{id}', [\App\Http\Controllers\MoviesController::class, 'edit'])->name('movie.edit');
    });

    Route::get('/home/movies/{slug}', [\App\Http\Controllers\CategoryController::class, 'show']);

    Route::get('/home/{slug}', [\App\Http\Controllers\MovieDetailsController::class, 'show']);
    Route::post('/home/{id}',[\App\Http\Controllers\MovieDetailsController::class,'addComment'])->name('comment.add');

});


//Route::get('/home/edit', function () {
//    $categories = Categories::all()->toArray();
//
//    return view('movie.edit')->with(compact("categories"));
//})->name('edit');

//Route::get('/home/sendMail', [\App\Http\Controllers\MailController::class,'sendMail']);


