<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ProductController;

Route::get('/', [ProductController::class, 'home']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/search', [ProductController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::post('/cart/add', [\App\Http\Controllers\Shop\CartController::class, 'add'])->name('cart.add');

/* ADMIN */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin-panel');
    })->name('panel');

    Route::get('/add-product', function () {
        return view('admin-add-product');
    })->name('product.add');

    Route::get('/edit-product', function () {
        return view('admin-edit-product');
    })->name('product.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/user-account', function () {
        $userInfo = Auth::user()->userInfo;
        return view('user-account', compact('userInfo'));
    })->name('user-account');
});

require __DIR__.'/auth.php';
