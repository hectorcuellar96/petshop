<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tienda', [ProductController::class, 'index'])->name('shop');
Route::get('/producto/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/carrito/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/pedido/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
