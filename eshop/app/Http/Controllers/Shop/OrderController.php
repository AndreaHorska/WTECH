<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserInfo;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::user();

        $cartData = app(CartController::class)->getCartData();
        $cartItems = $cartData['cartItems'];

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $shippingMethodId = session('checkout.shipping_method_id');
        $paymentMethodId = session('checkout.payment_method_id');

        if (!$shippingMethodId || !$paymentMethodId) {
            return redirect()->route('cart.shipping')->with('error', 'Missing shipping/payment');
        }

        if ($user && $user->userInfo) {
            $userInfo = $user->userInfo;
            $address = $userInfo->addresses()->first();
        } else {
            $userInfo = UserInfo::create([
                'first_name'    => $request->input('first-name'),
                'last_name'     => $request->input('last-name'),
                'email_address' => $request->input('email'),
                'phone_number'  => $request->input('phone'),
            ]);

            $countryMap = [
                'sk' => 'Slovakia',
                'cz' => 'Czech Republic',
                'de' => 'Germany',
            ];

            $address = Address::create([
                'street' => $request->input('street'),
                'house_number' => $request->input('house-number'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('zip'),
                'state' => $countryMap[$request->input('country')] ?? 'Slovakia',
            ]);

            $userInfo->addresses()->attach($address->id);
        }

        foreach ($cartItems as $item) {
            $productId = $item->product_id ?? $item['product_id'];
            $quantity = (int) data_get($item, 'quantity', 1);
            $product = Product::find($productId);

            if (!$product || $product->quantity < $quantity) {
                return redirect()->route('cart.index')
                    ->with('error', "Product \"{$product->name}\" is out of stock.");
            }
        }

        DB::transaction(function () use ($user, $cartItems, $shippingMethodId, $paymentMethodId, $address, $userInfo) {

            $order = Order::create([
                'user_info_id' => $userInfo->id,
                'shipping_address_id' => $address->id,
                'billing_address_id' => $address->id,
                'shipping_method_id' => $shippingMethodId,
                'state' => 'Created',
            ]);

            $total = 0;

            foreach ($cartItems as $item) {
                $productId = $item->product_id ?? $item['product_id'];
                $price = data_get($item, 'price', data_get($item, 'product.price', 0));
                $quantity = (int) data_get($item, 'quantity', 1);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $quantity,
                    'item_price' => $price,
                ]);

                Product::where('id', $productId)->decrement('quantity', $quantity);

                $total += $price * $quantity;
            }

            $order->update(['total_price' => $total]);

            Payment::create([
                'order_id' => $order->id,
                'payment_method_id' => $paymentMethodId,
                'amount' => $total,
                'state' => 'Unpaid',
            ]);

            // Vymazat kosik
            if (Auth::check() && $user = Auth::user()) {
                $cart = Cart::where('user_id', $user->id)->first();
                if ($cart) {
                    $cart->cartItems()->delete();
                    $cart->delete();
                }
            } else {
                session()->forget('cart');
            }
        });

        return redirect()->route('cart.index')->with('success', 'Order created!');
    }
}