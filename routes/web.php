<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\WebhookController;


use Illuminate\Support\Facades\Auth;

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

Auth::routes();



// <!--==========================================  (HOME)  ========================================================================================================================-->


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index']);


// <!--==========================================  (Dashboard)  ============================================================================================================================-->

// كل المسارات داخل هذا الجروب ستكون محمية بصلاحيات المدير
Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/dashboard', [ChartController::class, 'index'])->name('dashboard');

    // <!--==========================================  (Users)  ===============================================================================================================-->
    Route::resource('users', UserController::class);

    // <!--==========================================  (contacts)  ===============================================================================================================-->
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // <!--==========================================  (Categories)  =================================================================================================================-->
    Route::resource('categories', CategoryController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('brands', BrandController::class);
Route::put('/categories/soft-delete/{id}', [CategoryController::class, 'softDelete'])->name('categories.softDelete');

    // <!--==========================================  (Sub Categories)  =================================================================================================================-->

    // <!--==========================================  (Products)  ===================================================================================================================-->
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::delete('/product_images/{product_image}', [ProductImageController::class, 'destroy'])->name('product_images.destroy');

    // <!--==========================================  (Orders)  ===================================================================================================================-->
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::put('/order/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');

    // <!--==========================================  (Feedback)  ===================================================================================================================-->
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // <!--==========================================  (Webhook)  ===================================================================================================================-->
    Route::get('/dashboard/webhook-events', [WebhookController::class, 'showWebhookEvents'])->name('dashboard.webhook-events');
});


// <!--==========================================  (profile)  ===============================================================================================================-->
// هذا الوسيط 'role' قد يكون للمستخدم العادي والمدير معاً، يمكنك إبقاؤه كما هو إذا كان هذا هو القصد
Route::get('/profile_dashboard', [UserController::class, 'show_profile_dash'])->name('profile_dash.show')->middleware(['auth' , 'role']);
Route::put('/profile_dash_edit', [UserController::class, 'update_profile_dash'])->name('profile_dash.update')->middleware(['auth' , 'role']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update_profile'])->name('profile.update');
    Route::get('/order-details/{id}', [OrderController::class, 'getOrderDetails'])->name('order.details');
});




// <!--==========================================  (Public Routes)  ===============================================================================================================-->
// Public contact routes
Route::get('/contact', [ContactController::class, 'landing'])->name('contact.landing');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public product routes
Route::get('/product_details/{id}',[ProductController::class, 'show_user_side'])->name("product_details");
Route::get('/subcategory/{id}', [ProductController::class, 'productsBySubCategory'])->name('products.bySubCategory');
Route::get('/category/{id}', [ProductController::class, 'productsByCategory'])->name('products.byCategory');
Route::get('/subcategory/{id}/filter', [ProductController::class, 'productsBySubCategory'])->name('products.filterSubCategory');
Route::get('/category/{id}/filter', [ProductController::class, 'productsByCategory'])->name('products.filterCategory');

// Public cart routes
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{product_id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Public order routes
Route::get('/checkoutView', [OrderController::class, 'create'])->name('order.create');
Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');

// Public feedback routes
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

// Payment Routes
Route::get('/pay', [PaymentController::class, 'index']);
Route::post('/payment-proofs/{payment_proof}/review', [PaymentController::class, 'review'])->name('payment-proofs.review');

// Webhook for Square
Route::post('/webhooks/square', [WebhookController::class, 'handle']);
Route::post('/square/webhook', [PaymentController::class, 'handleWebhook']);
