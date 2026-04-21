@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/cart.css',
    ])
@endpush

@section('title', 'Cart - Shipping Info')

@section('content')

    @php
        $cartCollection = collect($cartItems ?? []);

        $subtotal = $cartCollection->sum(function ($item) {
            $price = data_get($item, 'price', data_get($item, 'product.price', 0));
            $quantity = (int) data_get($item, 'quantity', 0);

            return $price * $quantity;
        });

        $discount = 0;
        $total = $subtotal - $discount;
    @endphp

    <main class="cart-page">
        <nav class="checkout-steps" aria-label="Checkout steps">
            <ol class="checkout-steps-list">
                <li class="checkout-step">
                    <span class="checkout-step-circle">1</span>
                    <span class="checkout-step-label">Cart</span>
                </li>
                <li class="checkout-step active">
                    <span class="checkout-step-circle">2</span>
                    <span class="checkout-step-label">Shipping &amp; Payment</span>
                </li>
                <li class="checkout-step">
                    <span class="checkout-step-circle">3</span>
                    <span class="checkout-step-label">Customer Info</span>
                </li>
            </ol>
        </nav>

        <section class="cart-shipping-layout" aria-labelledby="cart-heading">

            <div class="checkout-options">
                <h2 class="form-section-title">Select delivery method</h2>
                <div class="options-group">
                    <label class="option-item">
                        <input type="radio" name="delivery">
                        <span class="option-icon">🏠</span>
                        <span class="option-name">Home Delivery</span>
                        <span class="option-price">2,99 €</span>
                        <span class="option-eta">by 28.9.</span>
                    </label>

                    <label class="option-item">
                        <input type="radio" name="delivery">
                        <span class="option-icon">🏪</span>
                        <span class="option-name">Store Pickup</span>
                        <span class="option-price">free</span>
                        <span class="option-eta">now</span>
                    </label>
                </div>

                <h2 class="form-section-title">Select payment method</h2>
                <div class="options-group">
                    <label class="option-item">
                        <input type="radio" name="payment">
                        <span class="option-icon">💳</span>
                        <span class="option-name">Credit Card</span>
                        <span class="option-price">free</span>
                    </label>

                    <label class="option-item">
                        <input type="radio" name="payment">
                        <span class="option-icon">🏦</span>
                        <span class="option-name">Bank Transfer</span>
                        <span class="option-price">free</span>
                    </label>

                    <label class="option-item">
                        <input type="radio" name="payment">
                        <span class="option-icon">🪙</span>
                        <span class="option-name">Pay on Delivery</span>
                        <span class="option-price">2,99 €</span>
                    </label>
                </div>

                <div class="form-buttons">
                    <a href="{{ route('cart.index') }}" class="back-button">Back</a>
                    <a href="{{ route('cart.shipping') }}" class="continue-button">Continue</a>
                </div>
            </div>

            <section class="cart-main">

                <ul class="cart-list">
                    <h2 id="summary-heading" class="order-summary-title">Order summary</h2>

                    @foreach ($cartCollection as $item)
                        @php
                            $product = data_get($item, 'product');
                            $productId = data_get($item, 'product_id', data_get($product, 'id'));
                            $name = data_get($item, 'name', data_get($product, 'name', 'Product'));
                            $price = (float) data_get($item, 'price', data_get($product, 'price', 0));
                            $quantity = (int) data_get($item, 'quantity', 1);
                            $lineTotal = $price * $quantity;
                            $image = $product->images->first();
                        @endphp

                        <li class="cart-item">
                            <a href="{{ route('product.show', $productId) }}">
                                <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $name }}" class="cart-item-image">
                            </a>

                            <div class="summary-item-details">
                                <a href="{{ $productId ? route('product.show', $productId) : '#' }}" class="cart-item-title">
                                    {{ $name }}
                                </a>
                                <span class="summary-product-quantity">{{ $quantity }}×</span>
                            </div>

                            <p class="summary-item-price">{{ $lineTotal }} €</p>

                        </li>
                    @endforeach

                </ul>

                <hr class="summary-divider">

                <dl class="summary-prices">
                    <dt>Subtotal</dt>
                    <dd>{{ number_format($subtotal, 2, ',', ' ') }} €</dd>

                    <dt>Discount</dt>
                    <dd>- {{ number_format($discount, 2, ',', ' ') }} €</dd>

                    <dt>Delivery</dt>
                    <dd>0,00 €</dd>

                    <dt>Payment</dt>
                    <dd>0,00 €</dd>
                </dl>

                <hr class="summary-divider">

                <dl class="summary-totals">
                    <dt>Total</dt>
                    <dd>{{ number_format($total, 2, ',', ' ') }} €</dd>
                </dl>

            </section>
        </section>
    </main>
@endsection








