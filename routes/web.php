<?php

use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\CheckOutController;
use App\Http\Controllers\customer\HomeController;
use App\Http\Controllers\customer\ProductController;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', function () {
    return view('customer.contact');
});
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/single-product', [ProductController::class, 'index'])->name('single-product');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
Route::get('/confirmation', [CheckOutController::class, 'invoice'])->name('confirmation');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
