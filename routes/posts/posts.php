<?php

use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)
    ->middleware('auth')
    ->prefix('admin/posts')
    ->group(function() {

        Route::get('/', 'index')->name('post.index');
        Route::get('/create', 'create')->name('post.create');
        Route::get('/{post}/edit', 'edit')->name('post.edit');

        Route::post('/', 'store')->name('post.store');

        Route::delete('/{post}/destroy', 'destroy')->name('post.destroy');

        Route::patch('/{post}/update', 'update')->name('post.update');

});
