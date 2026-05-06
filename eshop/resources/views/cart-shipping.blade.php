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
        <x-checkout-steps :active="2" />

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








