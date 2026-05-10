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

            <form class="customer-info-form" action="{{ route('cart.placeOrder') }}" method="POST" novalidate>
                @csrf
                <section class="form-section">
                    <h2 class="form-section-title">Personal Information</h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" placeholder="John"
                                   value="{{ old('first-name', $userInfo->first_name ?? '') }}" required>
                            @error('first-name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" placeholder="Doe"
                                   value="{{ old('last-name', $userInfo->last_name ?? '') }}" required>
                            @error('last-name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group full-width">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="john.doe@stuba.sk"
                                   value="{{ old('email', auth()->user()?->email ?? '') }}" required>
                            @error('email')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group full-width">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+421 012 345 698"
                                   value="{{ old('phone', $userInfo->phone_number ?? '') }}" required>
                            @error('phone')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </section>

                <section class="form-section">
                    <h2 class="form-section-title">Shipping Address</h2>
                    <div class="form-grid">
                        <div class="form-group half-width">
                            <label for="street">Street</label>
                            <input type="text" id="street" name="street" placeholder="Main Street"
                                   value="{{ old('street', $address->street ?? '') }}" required>
                            @error('street')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="house-number">House Number</label>
                            <input type="text" id="house-number" name="house-number" placeholder="123"
                                   value="{{ old('house-number', $address->house_number ?? '') }}" required>
                            @error('house-number')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" placeholder="Bratislava"
                                   value="{{ old('city', $address->city ?? '') }}" required>
                            @error('city')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="zip">ZIP Code</label>
                            <input type="text" id="zip" name="zip" placeholder="841 05"
                                   value="{{ old('zip', $address->postal_code ?? '') }}" required>
                            @error('zip')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group full-width">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" placeholder="Slovakia"
                                   value="{{ old('country', $address->state ?? '') }}" required>
                            @error('country')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </section>

                <div class="different-billing-address">
                    <label class="billing-checkbox-container">
                        <input type="checkbox" id="toggle-billing" name="different-billing" class="checkbox"
                            {{ old('different-billing') === 'on' ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        Billing address is different from shipping
                    </label>
                </div>

                <section id="billing-section" class="form-section {{ old('different-billing') === 'on' ? '' : 'hidden' }}">
                    <h2 class="form-section-title">Billing Address</h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label for="billing-company">Company Name (Optional)</label>
                            <input type="text" id="billing-company" name="billing-company"
                                   placeholder="Company s.r.o." value="{{ old('billing-company') }}">
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-street">Street</label>
                            <input type="text" id="billing-street" name="billing-street"
                                   placeholder="Billing Street" value="{{ old('billing-street') }}">
                            @error('billing-street')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-house-number">House Number</label>
                            <input type="text" id="billing-house-number" name="billing-house-number"
                                   placeholder="456" value="{{ old('billing-house-number') }}">
                            @error('billing-house-number')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-city">City</label>
                            <input type="text" id="billing-city" name="billing-city"
                                   placeholder="Bratislava" value="{{ old('billing-city') }}">
                            @error('billing-city')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group half-width">
                            <label for="billing-zip">ZIP Code</label>
                            <input type="text" id="billing-zip" name="billing-zip"
                                   placeholder="841 05" value="{{ old('billing-zip') }}">
                            @error('billing-zip')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group full-width">
                            <label for="billing-country">Country</label>
                            <input type="text" id="billing-country" name="billing-country"
                                   placeholder="Slovakia" value="{{ old('billing-country') }}">
                            @error('billing-country')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
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
