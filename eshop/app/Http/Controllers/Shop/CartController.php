<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $cart = Cart::with('cartItems.product')
                ->where('user_id', Auth::id())
                ->first();

            $cartItems = $cart ? $cart->cartItems : collect();
        } else {
            $sessionCart = session()->get('cart', []);

            $productIds = collect($sessionCart)->pluck('product_id')->filter()->all();
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $cartItems = collect($sessionCart)->map(function ($item) use ($products) {
                $item['product'] = $products[$item['product_id']] ?? null;
                return $item;
            });
        }

        return view('cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity', 1));

        $product = Product::findOrFail($productId);

        $currentInCart = 0;
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $item = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();
                $currentInCart = $item ? $item->quantity : 0;
            }
        } else {
            $cart = session()->get('cart', []);
            $currentInCart = $cart[$productId]['quantity'] ?? 0;
        }

        $available = $product->quantity - $currentInCart;

        if ($quantity > $available) {
            $quantity = max(0, $available);
        }

        if ($quantity <= 0) {
            return back()->with('error', 'Product is out of stock!');
        }

        if (Auth::check()) {
            // Prihlaseny - kosik je v databaze
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['total_price' => 0]
            );

            $item = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }

            $cart->total_price = $cart->cartItems()
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->sum(\DB::raw('cart_items.quantity * products.price'));
            $cart->save();

        } else {
            // Neprihlaseny
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart', $cart);
        }
        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $productId)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $item = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($item) {
                    $item->quantity = $quantity;
                    $item->save();

                    $this->recalculateCartTotal($cart);
                }
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        return back();
    }

    public function remove($productId)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->delete();

                $this->recalculateCartTotal($cart);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }

        return back();
    }
    private function recalculateCartTotal(Cart $cart): void
    {
        $cart->total_price = $cart->cartItems()
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->sum(\DB::raw('cart_items.quantity * products.price'));

        $cart->save();
    }

}
