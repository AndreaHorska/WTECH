<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;

class CartController extends Controller
{

    private function calculateCartSummary($cartItems): array
    {
        $cartItems = collect($cartItems);

        $subtotal = $cartItems->sum(function ($item) {
            $price = data_get($item, 'price', data_get($item, 'product.price', 0));
            $quantity = (int) data_get($item, 'quantity', 0);

            return $price * $quantity;
        });

        $discount = 0;

        return [
            'subtotal' => $subtotal,
            'discount' => $discount,
        ];
    }

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

        $summary = $this->calculateCartSummary($cartItems);

        return view('cart', [
            'cartItems' => $cartItems,
            'subtotal' => $summary['subtotal'],
            'discount' => $summary['discount'],
            'total' => $summary['subtotal'] - $summary['discount'],
        ]);
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

        if ($available <= 0) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Out of stock.'], 422);
            }
            return back()->with('error', 'Out of stock.');
        }

        if ($quantity > $available) {
            if ($request->expectsJson()) {
                return response()->json(['warning' => "Only {$available} items available in stock."], 422);
            }
            return back()->with('warning', "Only {$available} items available in stock.");
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

            $cartCount = $cart->cartItems()->sum('quantity');

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

            $cartCount = collect($cart)->sum('quantity');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cartCount' => $cartCount,
            ]);
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

    public function count()
    {
        if (Auth::check()) {
            $cart = Cart::with('cartItems')
                ->where('user_id', Auth::id())
                ->first();

            $count = $cart ? $cart->cartItems->sum('quantity') : 0;
        } else {
            $count = collect(session()->get('cart', []))->sum('quantity');
        }

        return response()->json([
            'count' => $count,
        ]);
    }

    public function shipping()
    {
        if (Auth::check()) {
            $cart = Cart::with('cartItems.product.images')
                ->where('user_id', Auth::id())
                ->first();

            $cartItems = $cart ? $cart->cartItems : collect();
        } else {
            $sessionCart = session()->get('cart', []);

            $productIds = collect($sessionCart)->pluck('product_id')->filter()->all();
            $products = Product::with('images')->whereIn('id', $productIds)->get()->keyBy('id');

            $cartItems = collect($sessionCart)->map(function ($item) use ($products) {
                $item['product'] = $products[$item['product_id']] ?? null;
                return $item;
            });
        }

        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        $summary = $this->calculateCartSummary($cartItems);

        return view('cart-shipping', [
            'cartItems' => $cartItems,
            'shippingMethods' => $shippingMethods,
            'paymentMethods' => $paymentMethods,
            'subtotal' => $summary['subtotal'],
            'discount' => $summary['discount'],
        ]);
    }


    public function saveShippingOption(Request $request)
    {
        if ($request->filled('delivery')) {
            session(['checkout.shipping_method_id' => $request->delivery]);
        }

        if ($request->filled('payment')) {
            session(['checkout.payment_method_id' => $request->payment]);
        }

        return response()->json(['success' => true]);
    }

    public function saveShipping(Request $request)
    {
        $validated = $request->validate([
            'delivery' => ['required', 'exists:shipping_methods,id'],
            'payment' => ['required', 'exists:payment_methods,id'],
        ]);

        session([
            'checkout.shipping_method_id' => $validated['delivery'],
            'checkout.payment_method_id' => $validated['payment'],
        ]);

        return back();
    }



}
