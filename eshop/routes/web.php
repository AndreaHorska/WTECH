<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/products', function () {
    return view('index');
});

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/admin-add-product', function () {
    return view('admin-add-product');
});

Route::get('/admin-edit-product', function () {
    return view('admin-edit-product');
});

Route::get('/admin-panel', function () {
    return view('admin-panel');
})->name('admin-panel');

Route::middleware('auth')->group(function () {
    Route::get('/user-account', function () {
        return view('user-account');
    })->name('user-account');
});

require __DIR__.'/auth.php';
