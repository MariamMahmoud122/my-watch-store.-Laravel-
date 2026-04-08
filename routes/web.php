<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AuthController;
// 1. المتجر (الزبون)
Route::get('/', [ProductController::class, 'shopIndex'])->name('shop.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('shop.product.show');


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/remove-from-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); 
Route::post('/confirm-order', [CartController::class, 'confirmOrder'])->name('cart.confirm'); 


Route::resource('admin/products', ProductController::class);

Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');



Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::patch('/admin/orders/{id}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
Route::delete('/admin/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');


Route::post('/register', [AuthController::class, 'register']);
// إضافة middleware('auth') عشان يمنع غير المسجلين
Route::post('/confirm-order', [CartController::class, 'confirmOrder'])
      ->name('cart.confirm')
      ->middleware('auth');