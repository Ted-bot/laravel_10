<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;

Route::controller(AdminsController::class)
->middleware('auth')
->group(function() {

    Route::get('/admin', 'index')->name('admin.index');

});

Route::middleware('auth')
->group(function() {
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/comments', 'PostCommentsController');
    Route::resource('/admin/comments/replies', 'CommentRepliesController');
    Route::post('/admin/comments/replies', 'CommentRepliesController@show');
    Route::post('/admin/comments/replies', 'CommentRepliesController@createReply')->name('replies.createReply');
});

