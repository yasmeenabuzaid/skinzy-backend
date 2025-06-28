<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

Route::post('/e-commerce/customer/auth/register', [AuthController::class, 'register']);
Route::post('/e-commerce/customer/auth/login', [AuthController::class, 'login']);
Route::prefix('e-commerce/customer')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    // بقية الراوتس...
});

Route::middleware('auth:sanctum')->prefix('e-commerce/customer')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
});

