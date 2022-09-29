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
        $categories = Categories::all()->toArray();
        return view('about')->with(compact('categories'));
    });

    Route::get('/home/profile',[\App\Http\Controllers\ProfileController::class,'show'])->name('profile.show');
    Route::post('/home/profile/edit/{id}',[\App\Http\Controllers\ProfileController::class,'edit'])->name('profile.edit');


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
    Route::post('/home/comment/{id}',[\App\Http\Controllers\MovieDetailsController::class,'deleteComment'])->name('comment.delete');


});



