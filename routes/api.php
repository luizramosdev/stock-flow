<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::post('/login', [AuthController::class, 'auth']);

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/{id}', [UsersController::class, 'show']);
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/', [UsersController::class, 'store']);
});

Route::group(['prefix' => 'products', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
});

Route::group(['prefix' => 'stock', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/checkin', [StockController::class, 'index']);
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::get('/{id}', [StockController::class, 'show']);
    Route::post('/checkin', [StockController::class, 'store']);
    Route::post('/checkout', [CheckoutController::class, 'store']);
});
