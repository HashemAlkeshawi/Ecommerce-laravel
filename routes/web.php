<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\UserController;
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




Route::get('/', function () {
    return redirect('/user/dashboard');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('user/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth', 'check_role']);

Route::get('user/login', 'App\Http\Controllers\LoginController@login')->middleware('check_autherized')->name('login');

Route::post('user/authenticate', 'App\Http\Controllers\LoginController@authenticate');

Route::get('user/create', 'App\Http\Controllers\UserController@create')->middleware('check_autherized');

Route::get('user/logout', 'App\Http\Controllers\LoginController@logout');

Route::post('user/', 'App\Http\Controllers\UserController@store');

Route::resource('user', UserController::class)->except(['create', 'store'])->middleware(['auth', 'check_role']);

Route::resource('vendor', VendorController::class)->middleware(['auth', 'check_role']);
Route::resource('address', AddressController::class)->middleware(['auth', 'check_role']);

Route::resource('brand', BrandController::class)->only(['create', 'edit', 'store', 'update', 'destroy'])->middleware(['auth', 'check_role']);
Route::resource('brand', BrandController::class)->only(['index', 'show'])->middleware('auth');
Route::get('brand/{brand_id}/item', 'App\Http\Controllers\ItemController@createForBrand')->middleware(['auth', 'check_role']);

Route::resource('item', ItemController::class)->only(['create', 'edit', 'store', 'update', 'destroy'])->middleware(['auth', 'check_role']);
Route::resource('item', ItemController::class)->only(['index', 'show'])->middleware('auth');

Route::resource('inventory', InventoryController::class)->middleware(['auth', 'check_role']);

Route::get('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@create')->middleware(['auth', 'check_role']);
Route::post('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@store')->middleware(['auth', 'check_role']);
Route::delete('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@destroy')->middleware(['auth', 'check_role']);

// Route::get('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@create')->middleware(['auth', 'check_role']);
// Route::post('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@store')->middleware(['auth', 'check_role']);
// Route::delete('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@destroy')->middleware(['auth', 'check_role']);

Route::get('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@create')->middleware(['auth', 'check_role']);
Route::post('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@store')->middleware(['auth', 'check_role']);
Route::delete('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@destroy')->middleware(['auth', 'check_role']);

Route::get('cart', 'App\Http\Controllers\CartController@index')->middleware('auth');
Route::post('cart', 'App\Http\Controllers\CartController@store')->middleware('auth');
Route::delete('cart', 'App\Http\Controllers\CartController@destroy')->middleware('auth');
Route::delete('cart/empty', 'App\Http\Controllers\CartController@empty')->middleware('auth');

Route::resource('purchase', PurchaseOrderController::class)->middleware('auth');
