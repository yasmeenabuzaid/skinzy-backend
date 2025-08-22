<?php
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Auth\ApiLoginController;

Route::prefix('e-commerce/customer')->group(function () {
    Route::post('/auth/register', [ApiRegisterController::class, 'register']);
    Route::post('/auth/login', [ApiLoginController::class, 'login']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/subcategory/{subcategoryId}', [ProductController::class, 'getProductsBySubCategory']);
    Route::get('/products/category/{CategoryId}', [CategoryController::class, 'productsByCategory']); // هذا المسار الجديد
    Route::get('/single-products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/products/brand/{brandId}', [ProductController::class, 'getProductsByBrand']);
  Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/auth/reset-password', [ForgotPasswordController::class, 'resetPassword']);
    Route::get('/subcategories', [SubCategoryController::class, 'getWithSubcategories']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites', [FavoriteController::class, 'index']);

    Route::delete('/favorites', [FavoriteController::class, 'destroy']);
    Route::get('/cities', [OrderController::class, 'getCities']);
});

Route::middleware('auth:sanctum')->prefix('e-commerce/customer')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::get('/cart/count', [CartController::class, 'getCartCount']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::patch('/cart', [CartController::class, 'updateCart']);
    Route::patch('/cart/update', [CartController::class, 'updateCartq']);

    Route::patch('/favorites/{productId}', [FavoriteController::class, 'destroy']);
    Route::get('/addresses', [OrderController::class, 'getUserAddress']);
    Route::delete('/addresses/{id}', [OrderController::class, 'deleteAddress']);
    Route::post('/addresses', [OrderController::class, 'addAddress']);
    Route::post('/orders/checkout', [OrderController::class, 'createOrder']);
});
