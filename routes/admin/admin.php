<?php

use Illuminate\Support\Facades\Route;


// Route::middleware('auth')->group(function(){
Route::controller(PostController::class)
->middleware('auth')
->name('admin')->group(function() {

    Route::get('/admin', 'App\Http\Controllers\AdminsController@index')->name('admin.index');

});
