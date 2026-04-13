<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();

                $count = $cart 
                    ? $cart->cartItems()->sum('quantity') 
                    : 0;

            } else {
                $count = collect(session('cart', []))->sum('quantity');
            }

            $view->with('cartCount', $count);
        });
    }
}
