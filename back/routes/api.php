<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [ AuthController::class, 'register']);
Route::post('login', [ AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('account', [AccountController::class, 'create']);
    Route::get('account/show', [AccountController::class, 'show']);
    Route::get('account/show-details/{id}', [AccountController::class, 'showDetails']);
    Route::put('account/update/{account}', [AccountController::class, 'update']);
    Route::delete('account/{account}', [AccountController::class, 'destroy']);


});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
