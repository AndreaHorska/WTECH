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
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity', 1));

        $product = Product::findOrFail($productId);

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
}