<?php

use App\Http\Controllers\admin\ProductManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\CheckOutController;
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ProductController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\TrackingController;
use Illuminate\Support\Facades\Route;



// Admin Endpoints
Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin-profile', function () {
    return view('admin.profile-management');
});
Route::get('/order-management', function () {
    return view('admin.order-management');
});
Route::get('/customer-management', function () {
    return view('admin.customer-management');
});

Route::get('/product-management', [ProductManagementController::class, 'index'])->name('admin.product-management');
Route::post('product-management/store', [ProductManagementController::class, 'store'])->name('product-management.store');
Route::put('product-management/update', [ProductManagementController::class, 'update'])->name('product-management.update');
Route::delete('/product-management/{id}', [ProductManagementController::class, 'destroy'])->name('product-management.destroy');
Route::post('/product-management/{id}/deactivate', [ProductManagementController::class, 'deactivate'])->name('product-management.deactivate');
Route::post('/product-management/{id}/activate', [ProductManagementController::class, 'activate'])->name('product-management.activate');


Route::get('/admin-login', function () {
    return view('admin.login');
});
Route::get('/admin-registration', function () {
    return view('admin.registration');
});





// Customer Endpoints
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', function () {
    return view('customer.contact');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/single-product/{id}', [ProductController::class, 'index'])->name('single-product');

Route::get('/cart/add/{id}/{qty}', [CartController::class, 'addToCartSingle']);
Route::post('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::post('/cart/update', [CartController::class, 'updateCart']);
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'submitOrder']);
    Route::get('/confirmation', [CheckOutController::class, 'invoice'])->name('order.summary');
    Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
});
