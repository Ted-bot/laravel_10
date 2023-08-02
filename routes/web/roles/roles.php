<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::controller(RoleController::class)
    ->group(function() {

        Route::get('/', 'index')->name('role.index');
        Route::get('/{role}/edit', 'edit')->name('role.edit');

        Route::post('/', 'store')->name('role.store');

        Route::delete('/{role}/destroy', 'destroy')->name('role.destroy');

        Route::put('/{role}/update', 'update')->name('role.update');

        Route::put('/{role}/attach', 'attach_permission')->name('role.permission.attach');
        Route::put('/{role}/detach', 'detach_permission')->name('role.permission.detach');

});
