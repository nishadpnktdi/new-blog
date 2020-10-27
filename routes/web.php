<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [BlogController::class, 'index']);

Route::get('/about', [BlogController::class, 'about']);

Route::get('/contact', [BlogController::class, 'contact']);

Route::get('/post/{id}', [BlogController::class, 'show']);

Route::post('/contact', [BlogController::class, 'contactForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('posts', App\Http\Controllers\PostController::class);

Route::resource('categories', App\Http\Controllers\CategoryController::class);

Route::resource('tags', App\Http\Controllers\TagController::class);

Route::resource('contacts', App\Http\Controllers\ContactController::class);

Route::resource('users', UserController::class)->middleware('auth');
