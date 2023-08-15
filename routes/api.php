<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\Auth\ApiLoginController;
use App\Http\Controllers\ApiControllers\Dashboard\ApiUserController;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return  new UserResource($request->user());
// });

Route::prefix('user/')->group(function () {
    Route::post('register', [ApiUserController::class,'store']);
    Route::post('login', 'App\Http\Controllers\ApiControllers\Auth\ApiLoginController@login');
    // Route::get('logout', 'App\Http\Controllers\ApiControllers\Auth\ApiLoginController@logout');
});
Route::resource('user', ApiUserController::class)->except(['create', 'store'])->middleware(['auth:api', 'check_role']);

Route::get('unauthenticated', function (Request $request) {
    return    response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
})->name('unauthenticated');
