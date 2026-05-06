<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\AdminProductController;
use App\Http\Controllers\Shop\AccountController;

Route::get('/', [ProductController::class, 'home']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/search', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add', [\App\Http\Controllers\Shop\CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

Route::get('/cart/shipping', [CartController::class, 'shipping'])->name('cart.shipping');
Route::post('/cart/shipping/save-option', [CartController::class, 'saveShippingOption'])->name('cart.shipping.option');
Route::post('/cart/shipping', [CartController::class, 'saveShipping'])->name('cart.shipping.save');
Route::get('/cart/customer', [CartController::class, 'customerInfo'])->name('cart.customer');

Route::get('/user-account', [AccountController::class, 'edit'])->middleware('auth')->name('account.edit');
Route::put('/user-account', [AccountController::class, 'update'])->middleware('auth')->name('account.update');

/* ADMIN */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminProductController::class, 'index'])->name('panel');

    Route::get('/add-product', [AdminProductController::class, 'create'])->name('product.add');
    Route::post('/add-product', [AdminProductController::class, 'store'])->name('product.store');

    Route::get('/edit-product/{id}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::put('/edit-product/{id}', [AdminProductController::class, 'update'])->name('product.update');

    Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');
});


require __DIR__.'/auth.php';
