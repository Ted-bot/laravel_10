<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group(function(){
Route::controller(PostController::class)
    ->middleware('auth')
    ->prefix('admin/posts')
    ->name('posts')->group(function() {

        Route::get('/', 'App\Http\Controllers\PostController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\PostController@create')->name('create');
        Route::get('/{post}/edit', 'App\Http\Controllers\PostController@edit')->name('pedit');

        Route::post('/', 'App\Http\Controllers\PostController@store')->name('store');

        Route::delete('/{post}/destroy', 'App\Http\Controllers\PostController@destroy')->name('destroy');

        Route::patch('/{post}/update', 'App\Http\Controllers\PostController@update')->name('update');

});
