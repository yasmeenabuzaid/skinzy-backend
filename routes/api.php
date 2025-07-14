<?php


use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Auth\ApiLoginController;

Route::prefix('e-commerce/customer')->group(function () {
    Route::post('/auth/register', [ApiRegisterController::class, 'register']);
    Route::post('/auth/login', [ApiLoginController::class, 'login']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites/{user_id}', [FavoriteController::class, 'index']);
    Route::delete('/favorites', [FavoriteController::class, 'destroy']);
    Route::get('/cities', [OrderController::class, 'getCities']);  // تأكد أن الراوت محمي هنا
});

Route::middleware('auth:sanctum')->prefix('e-commerce/customer')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart']);  // تأكد أن الراوت محمي هنا
    Route::get('/cart', [CartController::class, 'getCart']);  // تأكد أن الراوت محمي هنا
    Route::patch('/cart', [CartController::class, 'updateCart']);
    Route::patch('/cart/update', [CartController::class, 'updateCartq']);

    Route::get('/addresses', [OrderController::class, 'getUserAddress']);  // تأكد أن الراوت محمي هنا
    Route::delete('/addresses/{id}', [OrderController::class, 'deleteAddress']); // 🆕 راوت الحذف
    Route::post('/addresses', [OrderController::class, 'addAddress']);  // تأكد أن الراوت محمي هنا
    Route::post('/orders/checkout', [OrderController::class, 'CreateOrder']);  // تأكد أن الراوت محمي هنا
    // يمكنك إضافة المزيد من الراوتات التي تحتاج auth
});

