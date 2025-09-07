<?php
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Auth\ApiLoginController;

Route::post('/products/import', [ProductController::class, 'import']);
Route::post('/subcategories/import', [SubCategoryController::class, 'import']);
Route::post('/categories/import', [CategoryController::class, 'import']);
Route::post('/brands/import', [BrandController::class, 'import']);

// ------------------------------------------------------
Route::prefix('e-commerce/customer')->group(function () {
    Route::post('/auth/register', [ApiRegisterController::class, 'register'])->middleware('throttle:7,1');
    Route::post('/auth/login', [ApiLoginController::class, 'login'])->middleware('throttle:7,1');
    Route::get('/products', [ProductController::class, 'getProducts']);

    // هذا المسار الجديد
    Route::get('/single-products/{id}', [ProductController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('throttle:5,1');
    Route::post('/auth/reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('throttle:5,1');

    Route::get('/subcategories', [SubCategoryController::class, 'getWithSubcategories']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/cities', [OrderController::class, 'getCities']);
});

Route::middleware('auth:sanctum')->prefix('e-commerce/customer')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::get('/cart/count', [CartController::class, 'getCartCount']);

    Route::get('/cart', [CartController::class, 'getCart']);

    // check which one is correct
    Route::patch('/cart', [CartController::class, 'updateCart']);
    Route::patch('/cart/update', [CartController::class, 'updateCartq']);
    
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites', [FavoriteController::class, 'index']);

    // check which one is use
    Route::delete('/favorites', [FavoriteController::class, 'destroy']);
    Route::patch('/favorites/{productId}', [FavoriteController::class, 'destroy']);
    Route::get('/addresses', [OrderController::class, 'getUserAddress']);
    Route::delete('/addresses/{id}', [OrderController::class, 'deleteAddress']);
    Route::post('/addresses', [OrderController::class, 'addAddress']);
    Route::post('/orders/checkout', [OrderController::class, 'createOrder']);
});
