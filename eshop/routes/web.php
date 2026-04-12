<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\AdminProductController;

Route::get('/', [ProductController::class, 'home']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/search', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add', [\App\Http\Controllers\Shop\CartController::class, 'add'])->name('cart.add');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

/* ADMIN */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminProductController::class, 'index'])->name('panel');

    Route::get('/add-product', function () {
        return view('admin-add-product');
    })->name('product.add');

    Route::get('/edit-product/{id}', function () {
        return view('admin-edit-product');
    })->name('product.edit');

    Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('product.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/user-account', function () {
        $userInfo = Auth::user()->userInfo;
        return view('user-account', compact('userInfo'));
    })->name('user-account');
});

require __DIR__.'/auth.php';
