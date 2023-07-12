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
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('/d_user/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/d_user/authenticate', 'App\Http\Controllers\LoginController@do');
Route::get('/d_user/register','App\Http\Controllers\DUserController@create' );
Route::resource('d_user', DUserController::class)->except(['create'])->middleware('auth');
