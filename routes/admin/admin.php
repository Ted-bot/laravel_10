<?php

use Illuminate\Support\Facades\Route;

Route::controller(AdminsController::class)
->middleware('auth')
->group(function() {

    Route::get('/admin', 'index')->name('admin.index');

});
