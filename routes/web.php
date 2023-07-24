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
    Route::get('/admin', 'App\Http\Controllers\AdminsController@index')->name('admin.index');
    Route::get('/admin/posts/', 'App\Http\Controllers\PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::get('/admin/posts/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('post.edit');

    Route::get('/admin/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');
    Route::put('/admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');

    Route::post('/admin/posts', 'App\Http\Controllers\PostController@store')->name('post.store');

    Route::patch('/admin/posts/{post}/update', 'App\Http\Controllers\PostController@update')->name('post.update');

    Route::delete('/admin/posts/{post}/destroy', 'App\Http\Controllers\PostController@destroy')->name('post.destroy');

    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
});
