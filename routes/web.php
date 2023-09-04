<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use For

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/post/{post}', 'App\Http\Controllers\PostController@show')->name('post');

Route::middleware('auth')->group(function(){
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
});
