<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;

Route::controller(AdminsController::class)
->middleware('auth')
->group(function() {

    Route::get('/admin', 'index')->name('admin.index');

    Route::resource('admin/categories', 'AdminCategoriesController');

});


