@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/cart.css',
    ])
@endpush

@push('scripts')
    @vite(['resources/js/cart_shipping.js'])
@endpush

@section('title', 'Cart - Shipping Info')

@section('content')

    @php
        $selectedDelivery = session()->hasOldInput()
            ? old('delivery')
            : session('checkout.shipping_method_id');

        $selectedPayment = session()->hasOldInput()
            ? old('payment')
            : session('checkout.payment_method_id');

        $shippingFee = $selectedShipping?->fee ?? 0;
        $paymentFee = $selectedPayment?->fee ?? 0;

        $total = $subtotal + $shippingFee + $paymentFee
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

        <section class="cart-shipping-layout" aria-labelledby="cart-heading"
                 data-subtotal="{{ $subtotal }}">

            <div class="checkout-options">
                <form method="POST" action="{{ route('cart.shipping.save') }}">
                    @csrf

                    <h2 class="form-section-title">Select delivery method</h2>
                    <div class="options-group">
                        @foreach ($shippingMethods as $method)
                            <label class="option-item">
                                <input type="radio" name="delivery" value="{{ $method->id }}" data-fee="{{ $method->fee }}"
                                    @checked($selectedDelivery == $method->id)>
                                <span class="option-icon">{{ $method->icon }}</span>
                                <span class="option-name">{{ $method->name }}</span>
                                <span class="option-price">{{ $method->fee > 0 ? number_format($method->fee, 2, ',', ' ') . ' €' : 'free' }}</span>
                                <span class="option-eta">{{ $method->eta_text }}</span>
                            </label>
                        @endforeach
                    </div>

                    @error('delivery')
                    <p class="form-error">{{ $message }}</p>
                    @enderror

                    <h2 class="form-section-title">Select payment method</h2>
                    <div class="options-group">
                        @foreach ($paymentMethods as $method)
                            <label class="option-item">
                                <input
                                    type="radio" name="payment" value="{{ $method->id }}" data-fee="{{ $method->fee }}"
                                    @checked($selectedPayment == $method->id)>
                                <span class="option-icon">{{ $method->icon }}</span>
                                <span class="option-name">{{ $method->name }}</span>
                                <span class="option-price">{{ $method->fee > 0 ? number_format($method->fee, 2, ',', ' ') . ' €' : 'free' }}</span>
                            </label>
                        @endforeach
                    </div>

                    @error('payment')
                    <p class="form-error">{{ $message }}</p>
                    @enderror

                    <div class="form-buttons">
                        <a href="{{ route('cart.index') }}" class="back-button">Back</a>
                        <button type="submit" class="continue-button">Continue</button>
                    </div>
                </form>
            </div>

            <section class="cart-main">

                <ul class="cart-list">
                    <h2 id="summary-heading" class="order-summary-title">Order summary</h2>

                    @foreach ($cartItems as $item)
                        @php
                            $product = data_get($item, 'product');
                            $productId = data_get($item, 'product_id', data_get($product, 'id'));
                            $name = data_get($item, 'name', data_get($product, 'name', 'Product'));
                            $price = (float) data_get($item, 'price', data_get($product, 'price', 0));
                            $quantity = (int) data_get($item, 'quantity', 1);
                            $lineTotal = $price * $quantity;
                            $image = $product->images->first();
                        @endphp

                        <li class="summary-item">
                            <a href="{{ route('product.show', $productId) }}">
                                <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $name }}" class="cart-item-image">
                            </a>

                            <div class="summary-item-details">
                                <a href="{{ $productId ? route('product.show', $productId) : '#' }}" class="summary-item-title">
                                    {{ $name }}
                                </a>
                                <span class="summary-product-quantity">{{ $quantity }}×</span>
                            </div>

                            <p class="summary-item-price">{{ number_format($lineTotal, 2, ',', ' ') }} €</p>


                        </li>
                    @endforeach

                </ul>

                <hr class="summary-divider">

                <dl class="summary-prices">
                    <dt>Subtotal</dt>
                    <dd id="subtotalPrice">{{ number_format($subtotal, 2, ',', ' ') }} €</dd>

                    <dt>Delivery</dt>
                    <dd id="deliveryPrice">{{ number_format($shippingFee, 2, ',', ' ') }} €</dd>

                    <dt>Payment</dt>
                    <dd id="paymentPrice">{{ number_format($paymentFee, 2, ',', ' ') }} €</dd>
                </dl>

                <hr class="summary-divider">

                <dl class="summary-totals">
                    <dt>Total</dt>
                    <dd id="totalPrice">{{ number_format($total, 2, ',', ' ') }} €</dd>
                </dl>

            </section>
        </section>
    </main>
@endsection








