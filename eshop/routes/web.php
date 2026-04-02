<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Homepage
Route::get('/', function () {
    return view('index');
});

// Products
Route::get('/products', function () {
    return view('welcome');
});

Route::get('/product', function () {
    return view('product');
})->name('product');

// User account (auth protected)
Route::middleware('auth')->group(function () {
    Route::get('/user-account', function () {
        return view('user-account');
    })->name('user-account');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/user-account', function () {
    return view('user-account');
})->name('user.account')->middleware('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
