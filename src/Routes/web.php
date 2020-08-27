<?php

use Illuminate\Support\Facades\Route;

Route::namespace('ConfrariaWeb\User\Controllers')
    ->group(function () {

        Route::prefix('admin')
        ->name('admin.')
        ->middleware(['web', 'auth'])
        ->group(function () {

            Route::prefix('users')
            ->name('users.')
            ->group(function () {

                Route::post('token/generate/{id}', 'UserController@apiTokenGenerate')->name('token.generate');
            
                Route::get('datatable', 'UserController@datatables')->name('datatables');
            });

            Route::resource('users', 'UserController');
        });
    });
