<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group(function(){
Route::controller(PostController::class)
->middleware('auth')
->prefix('admin/users')
->name('user')->group(function() {

    Route::put('/{user}/update', 'App\Http\Controllers\UserController@update')->name('profile.update');

    Route::delete('/{user}/destroy', 'App\Http\Controllers\UserController@destroy')->name('destroy');
});

// Route::middleware(['role:admin', 'auth'])->group(function(){
Route::controller(PostController::class)
->middleware('auth')
->prefix('admin/users')
->name('user')->group(function() {

    Route::get('/', 'App\Http\Controllers\UserController@index')->name('index');

});

// Route::middleware(['auth', 'can:view,user'])->group(function(){
Route::controller(PostController::class)
->middleware('auth')
->prefix('admin/users')
->name('user')->group(function() {
    Route::get('/{user}/profile', 'App\Http\Controllers\UserController@show')->name('profile.show');
});
