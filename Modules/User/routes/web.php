<?php

use Modules\User\App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Route;

Route::prefix('user/')->group(function () {
    Route::middleware('check_autherized')->group(function () {
        Route::get('create', 'Modules\User\App\Http\Controllers\UserController@create');
    });
    Route::post('', 'Modules\User\App\Http\Controllers\UserController@store');
    Route::get('{user_id}/email', 'Modules\User\App\Http\Controllers\UserController@createEmail');
    Route::post('/email', 'Modules\User\App\Http\Controllers\UserController@email');
});
Route::resource('user', UserController::class)->except(['create', 'store'])->middleware(['auth', 'check_role']);
