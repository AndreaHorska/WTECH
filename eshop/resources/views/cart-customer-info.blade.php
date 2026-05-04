@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/cart.css',
    ])
@endpush

@push('scripts')
    @vite(['resources/js/billing_address.js'])
@endpush

@section('title', 'Cart - Customer Info')

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

        $total = $subtotal - $discount + $shippingFee + $paymentFee
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

            <form class="customer-info-form">
                <section class="form-section">
                    <h2 class="form-section-title">Personal Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" placeholder="Jozef"
                                   value="{{ $userInfo->first_name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" placeholder="Mrkvicka"
                                   value="{{ $userInfo->last_name ?? '' }}" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="jozko.mrkvicka@stuba.sk"
                                   value="{{ auth()->user()?->email ?? '' }}" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+421 012 345 698"
                                   value="{{ $userInfo->phone ?? '' }}">
                        </div>
                    </div>
                </section>

                <section class="form-section">
                    <h2 class="form-section-title">Shipping Address</h2>
                    <div class="form-grid">
                        <div class="form-group half-width">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" placeholder="Main Street"
                                   value="{{ $address->street ?? '' }}">
                        </div>
                        <div class="form-group half-width">
                            <label for="house-number">House Number</label>
                            <input type="text" id="house-number" name="house-number" placeholder="123"
                                   value="{{ $address->house_number ?? '' }}">
                        </div>
                        <div class="form-group half-width">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Bratislava"
                                   value="{{ $address->city ?? '' }}" required>
                        </div>
                        <div class="form-group half-width">
                            <label for="zip">ZIP Code</label>
                            <input type="text" id="zip" name="zip" placeholder="841 05"
                                   value="{{ $address->postal_code ?? '' }}" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="country">Country</label>
                            <select id="country" name="country">
                                <option value="sk" {{ ($address->state ?? '') === 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                <option value="cz" {{ ($address->state ?? '') === 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                <option value="de" {{ ($address->state ?? '') === 'Germany' ? 'selected' : '' }}>Germany</option>
                            </select>
                        </div>
                    </div>
                </section>

                <div class="different-billing-address">
                    <label class="billing-checkbox-container">
                        <input type="checkbox" id="toggle-billing" name="different-billing" class="checkbox">
                        <span class="checkmark"></span>
                        Billing address is different from shipping
                    </label>
                </div>

                <section id="billing-section" class="form-section hidden">
                    <h2 class="form-section-title">Billing Address</h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="billing-company">Company Name (Optional)</label>
                            <input type="text" id="billing-company" name="billing-company" placeholder="Firma s.r.o.">
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-street">Street</label>
                            <input type="text" id="billing-street" name="billing-street" placeholder="Billing Street">
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-house-number">Street and House Number</label>
                            <input type="text" id="billing-house-number" name="billing-house-number" placeholder="456">
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-city">City</label>
                            <input type="text" id="billing-city" name="billing-city" placeholder="Bratislava">
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-zip">ZIP Code</label>
                            <input type="text" id="billing-zip" name="billing-zip" placeholder="841 05">
                        </div>
                        <div class="form-group full-width">
                            <label for="billing-country">Country</label>
                            <select id="billing-country" name="billing-country">
                                <option value="sk">Slovakia</option>
                                <option value="cz">Czech Republic</option>
                                <option value="de">Germany</option>
                            </select>
                        </div>
                    </div>
                </section>

                <div class="form-buttons">
                    <a href="{{ route('cart.shipping') }}" class="back-button">Back</a>
                    <a href="{{ route('cart.shipping') }}" class="continue-button">Confirm Order</a>
                </div>
            </form>

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

                    <dt>Discount</dt>
                    <dd id="discountPrice">- {{ number_format($discount, 2, ',', ' ') }} €</dd>

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
