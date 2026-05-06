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
        $shippingFee = $selectedShippingMethod?->fee ?? 0;
        $paymentFee = $selectedPaymentMethod?->fee ?? 0;

        $total = $subtotal + $shippingFee + $paymentFee
    @endphp

    <main class="cart-page">
        <x-checkout-steps :active="3" />

        <section class="cart-shipping-layout" aria-labelledby="cart-heading">

            <form class="customer-info-form" action="{{ route('cart.placeOrder') }}" method="POST">
                @csrf
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
                                   value="{{ $userInfo->phone_number ?? '' }}" required>
                        </div>
                    </div>
                </section>

                <section class="form-section">
                    <h2 class="form-section-title">Shipping Address</h2>
                    <div class="form-grid">
                        <div class="form-group half-width">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" placeholder="Main Street"
                                   value="{{ $address->street ?? '' }}" required>
                        </div>
                        <div class="form-group half-width">
                            <label for="house-number">House Number</label>
                            <input type="text" id="house-number" name="house-number" placeholder="123"
                                   value="{{ $address->house_number ?? '' }}" required>
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
                            <input type="text" id="country" name="country" placeholder="Slovakia"
                                   value="{{ $address->state ?? '' }}" required>
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
                    <button type="submit" class="continue-button">
                        Confirm Order
                    </button>
                </div>
            </form>

            <x-cart-summary
                :cartItems="$cartItems"
                :subtotal="$subtotal"
                :shippingFee="$shippingFee"
                :paymentFee="$paymentFee"
                :total="$total"
            />

        </section>
    </main>
@endsection
