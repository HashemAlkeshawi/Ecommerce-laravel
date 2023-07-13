<?php

use App\Http\Controllers\DUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/d_user');
})->middleware('auth');

Route::get('/home', function () {
    return redirect('/d_user');
})->middleware('auth');

Route::get('d_user/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('d_user/authenticate', 'App\Http\Controllers\LoginController@authenticate');
Route::get('d_user/register', 'App\Http\Controllers\DUserController@create');
Route::post('d_user/', 'App\Http\Controllers\DUserController@store');
Route::resource('d_user', DUserController::class)->except(['create', 'store'])->middleware('auth');
