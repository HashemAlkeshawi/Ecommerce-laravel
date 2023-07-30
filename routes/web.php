<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Dashboard\InventoryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\VendorController;
use App\Http\Controllers\Item\BrandController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Item\Purchase\PurchaseOrderController;
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
        Route::get('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
        Route::get('create', 'App\Http\Controllers\Dashboard\UserController@create');
    });
    Route::get('dashboard', 'App\Http\Controllers\Dashboard\DashboardController@index')->middleware(['auth', 'check_role']);
    Route::post('authenticate', 'App\Http\Controllers\Auth\LoginController@authenticate');
    Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');
    Route::post('', 'App\Http\Controllers\Dashboard\UserController@store');
    Route::resource('', UserController::class)->except(['create', 'store'])->middleware(['auth', 'check_role']);
});

Route::middleware('auth')->group(function () {

    Route::middleware('check_role')->group(function () {
        Route::resource('vendor', VendorController::class);
        Route::resource('address', AddressController::class);
        Route::resource('brand', BrandController::class)->only(['create', 'edit', 'store', 'update', 'destroy']);
        Route::get('brand/{brand_id}/item', 'App\Http\Controllers\Item\ItemController@createForBrand');
        Route::resource('item', ItemController::class)->only(['create', 'edit', 'store', 'update', 'destroy']);
    });
    Route::resource('brand', BrandController::class)->only(['index', 'show']);
    Route::resource('item', ItemController::class)->only(['index', 'show']);
});

Route::middleware(['auth', 'check_role'])->group(function () {
    Route::get('vendor/{vendor_id}/item', 'App\Http\Controllers\Item\VendorItemController@create');
    Route::post('vendor/{vendor_id}/item', 'App\Http\Controllers\Item\VendorItemController@store');
    Route::delete('vendor/{vendor_id}/item', 'App\Http\Controllers\Item\VendorItemController@destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('cart', 'App\Http\Controllers\Item\Purchase\CartController@index');
    Route::post('cart', 'App\Http\Controllers\Item\Purchase\CartController@store');
    Route::delete('cart', 'App\Http\Controllers\Item\Purchase\CartController@destroy');
    Route::delete('cart/empty', 'App\Http\Controllers\Item\Purchase\CartController@empty');

    Route::resource('purchase', PurchaseOrderController::class);
});

Route::resource('inventory', InventoryController::class)->middleware(['auth', 'check_role']);
// Route::get('inventory/{inventory_id}/item', 'App\Http\Controllers\Item\InventoryItemController@create')->middleware(['auth', 'check_role']);
// Route::post('inventory/{inventory_id}/item', 'App\Http\Controllers\Item\InventoryItemController@store')->middleware(['auth', 'check_role']);
Route::delete('inventory/{inventory_id}/item', 'App\Http\Controllers\Item\InventoryItemController@destroy')->middleware(['auth', 'check_role']);

// Route::get('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@create')->middleware(['auth', 'check_role']);
// Route::post('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@store')->middleware(['auth', 'check_role']);
// Route::delete('inventory/{inventory_id}/vendor', 'App\Http\Controllers\InventoryVendorController@destroy')->middleware(['auth', 'check_role']);
