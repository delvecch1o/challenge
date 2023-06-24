<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\ContaPagarController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\TransferenciaController;

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

    Route::post('balance/transfer/{account}', [TransferenciaController::class, 'transfer']);

    Route::post('ticket', [ContaPagarController::class, 'create']);
    Route::get('ticket/show', [ContaPagarController::class, 'show']);
    Route::get('ticket/show-details/{id}', [ContaPagarController::class, 'showDetails']);
    Route::put('ticket/update/{contapagar}', [ContaPagarController::class, 'update']);
    Route::delete('ticket/{contapagar}', [ContaPagarController::class, 'destroy']);

    Route::post('transaction/ticket/{contapagar}/account/{account}', [TransactionController::class, 'transaction']);

    
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
