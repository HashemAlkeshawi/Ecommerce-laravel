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
    return redirect('/d_user/dashboard');
});

Route::get('/home', function () {
    return redirect('/d_user/dashboard');
});
Route::get('d_user/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('auth');

Route::get('d_user/login', 'App\Http\Controllers\LoginController@login')->middleware('check_autherized')->name('login');
Route::post('d_user/authenticate', 'App\Http\Controllers\LoginController@authenticate');
Route::get('d_user/create', 'App\Http\Controllers\DUserController@create')->middleware('check_autherized');
Route::get('d_user/logout', 'App\Http\Controllers\LoginController@logout');

Route::post('d_user/', 'App\Http\Controllers\DUserController@store');
Route::resource('d_user', DUserController::class)->except(['create', 'store'])->middleware(['auth','check_role']);
