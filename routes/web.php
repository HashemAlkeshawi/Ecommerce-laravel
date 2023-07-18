<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DUserController;
use App\Http\Controllers\VendorController;
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




//// !!! All routes needs to be fixed and grouped !!!



Route::get('/', function () {
    return redirect('/d_user/dashboard');
});
//// !!! All routes needs to be fixed and grouped !!!

Route::get('/home', function () {
    return redirect('/d_user/dashboard');
});
//// !!! All routes needs to be fixed and grouped !!!
Route::get('d_user/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('auth');

//// !!! All routes needs to be fixed and grouped !!!

Route::get('d_user/login', 'App\Http\Controllers\LoginController@login')->middleware('check_autherized')->name('login');

//// !!! All routes needs to be fixed and grouped !!!

Route::post('d_user/authenticate', 'App\Http\Controllers\LoginController@authenticate');

//// !!! All routes needs to be fixed and grouped !!!

Route::get('d_user/create', 'App\Http\Controllers\DUserController@create')->middleware('check_autherized');

//// !!! All routes needs to be fixed and grouped !!!

Route::get('d_user/logout', 'App\Http\Controllers\LoginController@logout');

//// !!! All routes needs to be fixed and grouped !!!


//// !!! All routes needs to be fixed and grouped !!!

Route::post('d_user/', 'App\Http\Controllers\DUserController@store');

//// !!! All routes needs to be fixed and grouped !!!

Route::resource('d_user', DUserController::class)->except(['create', 'store'])->middleware(['auth', 'check_role']);

//// !!! All routes needs to be fixed and grouped !!!

Route::resource('vendor', VendorController::class)->middleware(['auth', 'check_role']);
Route::resource('address', AddressController::class)->middleware(['auth', 'check_role']);

