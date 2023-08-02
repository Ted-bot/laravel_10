<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::controller(PostController::class)
    ->group(function() {

        Route::get('/', 'index')->name('post.index');
        Route::get('/create', 'create')->name('post.create');
        Route::get('/{post}/edit', 'edit')->name('post.edit');

        Route::post('/', 'store')->name('post.store');

        Route::delete('/{post}/destroy', 'destroy')->name('post.destroy');

        Route::patch('/{post}/update', 'update')->name('post.update');

});
