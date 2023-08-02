<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::controller(PermissionController::class)
    ->group(function() {

        Route::get('/', 'index')->name('permissions.index');
        Route::get('/{permission}/edit', 'edit')->name('permissions.edit');

        Route::post('/', 'store')->name('permissions.store');

        Route::delete('/{permission}/destroy', 'destroy')->name('permissions.destroy');

        Route::put('/{permission}/update', 'update')->name('permissions.update');

});
