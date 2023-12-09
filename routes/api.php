<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('verify.token')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/payment', [PaymentController::class, 'addHistory']);
    Route::delete('/payment/delete', [PaymentController::class, 'deleteHistory']);
    Route::get('/riwayat-pembelian', [PaymentController::class, 'riwayatPembelian']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
