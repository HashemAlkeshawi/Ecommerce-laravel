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

Route::prefix('user/')->group(function () {
    Route::middleware('check_autherized')->group(function () {
        Route::get('login', 'App\Http\Controllers\LoginController@login')->name('login');
        Route::get('create', 'App\Http\Controllers\UserController@create');
    });
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth', 'check_role']);
    Route::post('authenticate', 'App\Http\Controllers\LoginController@authenticate');
    Route::get('logout', 'App\Http\Controllers\LoginController@logout');
    Route::post('', 'App\Http\Controllers\UserController@store');
    Route::resource('user', UserController::class)->except(['create', 'store'])->middleware(['auth', 'check_role']);
});

Route::middleware('auth')->group(function () {

    Route::middleware('check_role')->group(function () {
        Route::resource('vendor', VendorController::class);
        Route::resource('address', AddressController::class);
        Route::resource('brand', BrandController::class)->only(['create', 'edit', 'store', 'update', 'destroy']);
        Route::get('brand/{brand_id}/item', 'App\Http\Controllers\ItemController@createForBrand');
        Route::resource('item', ItemController::class)->only(['create', 'edit', 'store', 'update', 'destroy']);
    });
    Route::resource('brand', BrandController::class)->only(['index', 'show']);
    Route::resource('item', ItemController::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'check_role'])->group(function () {
    Route::get('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@create');
    Route::post('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@store');
    Route::delete('vendor/{vendor_id}/item', 'App\Http\Controllers\VendorItemController@destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('cart', 'App\Http\Controllers\CartController@index');
    Route::post('cart', 'App\Http\Controllers\CartController@store');
    Route::delete('cart', 'App\Http\Controllers\CartController@destroy');
    Route::delete('cart/empty', 'App\Http\Controllers\CartController@empty');

    Route::resource('purchase', PurchaseOrderController::class);
});

Route::resource('inventory', InventoryController::class)->middleware(['auth', 'check_role']);
// Route::get('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@create')->middleware(['auth', 'check_role']);
// Route::post('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@store')->middleware(['auth', 'check_role']);
Route::delete('inventory/{inventory_id}/item', 'App\Http\Controllers\InventoryItemController@destroy')->middleware(['auth', 'check_role']);

// Route::get('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@create')->middleware(['auth', 'check_role']);
// Route::post('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@store')->middleware(['auth', 'check_role']);
// Route::delete('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@destroy')->middleware(['auth', 'check_role']);
