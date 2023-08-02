<?php

use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
->group(function() {

    Route::put('/{user}/update', 'update')->name('user.profile.update');

    Route::delete('/{user}/destroy', 'destroy')->name('user.destroy');

    Route::get('/', 'index')->name('user.index');

    Route::put('/{user}/attach', 'attach')->name('user.role.attach');
    Route::put('/{user}/Detach', 'detach')->name('user.role.detach');

});

Route::controller(UserController::class)
->middleware(['can:view,user'])
->group(function() {
    Route::get('/{user}/profile', 'show')->name('user.profile.show');
});
