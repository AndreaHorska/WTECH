<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Prenesenie session kosika
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            $cart = \App\Models\Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['total_price' => 0]
            );

            foreach ($sessionCart as $item) {
                $existing = \App\Models\CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $item['product_id'])
                    ->first();

                if ($existing) {
                    $existing->quantity += $item['quantity'];
                    $existing->save();
                } else {
                    \App\Models\CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                    ]);
                }
            }

            $cart->total_price = $cart->cartItems()
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->sum(\DB::raw('cart_items.quantity * products.price'));
            $cart->save();

            session()->forget('cart');
        }

        if (Auth::user()->roles->contains('name', 'ADMIN')) {
            return redirect()->intended(route('admin.panel'));
        }
        return redirect()->intended(route('account.edit'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
