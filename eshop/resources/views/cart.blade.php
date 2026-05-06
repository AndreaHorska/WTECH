@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/cart.css',
    ])
@endpush
@push('scripts')
    @vite(['resources/js/cart.js'])
@endpush

@section('title', 'Cart')

@section('content')

    <main class="cart-page">
        @if ($cartItems->isEmpty())
            <div class="cart-empty-page">
                <div class="cart-empty">
                    <p>Your cart is empty.</p>
                    <a href="{{ url('/') }}" class="continue-button">Back to shop</a>
                </div>
            </div>

        @else
            <nav class="checkout-steps" aria-label="Checkout steps">
                <ol class="checkout-steps-list">
                    <li class="checkout-step active">
                        <span class="checkout-step-circle">1</span>
                        <span class="checkout-step-label">Cart</span>
                    </li>
                    <li class="checkout-step">
                        <span class="checkout-step-circle">2</span>
                        <span class="checkout-step-label">Shipping &amp; Payment</span>
                    </li>
                    <li class="checkout-step">
                        <span class="checkout-step-circle">3</span>
                        <span class="checkout-step-label">Customer Info</span>
                    </li>
                </ol>
            </nav>

            <section class="cart-layout" aria-label="Cart items">

                <section class="cart-main">
                    <ul class="cart-list">
                        @foreach ($cartItems as $item)
                            @php
                                $product = data_get($item, 'product');
                                $productId = data_get($item, 'product_id', data_get($product, 'id'));
                                $name = data_get($item, 'name', data_get($product, 'name', 'Product'));
                                $price = (float) data_get($item, 'price', data_get($product, 'price', 0));
                                $quantity = (int) data_get($item, 'quantity', 1);
                                $lineTotal = $price * $quantity;

                                $image = $product->images->first();

                                $inStock = (int) data_get($product, 'quantity', 0) >= $quantity;
                            @endphp

                            <li class="cart-item">
                                <a href="{{ route('product.show', $productId) }}">
                                    <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $name }}" class="cart-item-image">
                                </a>

                                <div class="cart-item-description">
                                    <a href="{{ $productId ? route('product.show', $productId) : '#' }}" class="cart-item-title">
                                        {{ $name }}
                                    </a>
                                    <p class="cart-item-info">{{ data_get($product, 'description', '') }}</p>
                                </div>

                                <p class="stock-status {{ $inStock ? 'in-stock' : 'out-of-stock' }}">
                                    @if ($inStock)
                                        <svg class="stock-icon" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M20 6L9 17L4 12"/>
                                        </svg>
                                        <span>In stock</span>
                                    @else
                                        <svg class="stock-icon" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M18 6L6 18M6 6l12 12"/>
                                        </svg>
                                        <span>Out of stock</span>
                                    @endif
                                </p>

                                <form action="{{ route('cart.update', $productId) }}" method="POST" class="quantity-picker">
                                    @csrf
                                    @method('PATCH')

                                    <button type="button" class="quantity-button" aria-label="Decrease quantity">
                                        <svg class="quantity-icon" viewBox="0 0 24 24"><path d="M5 12h14"/></svg>
                                    </button>

                                    <input type="number" name="quantity" value="{{ $quantity }}" min="1" max="{{ data_get($product, 'quantity', 1) }}" class="quantity-input">

                                    <button type="button" class="quantity-button" aria-label="Increase quantity">
                                        <svg class="quantity-icon" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                                    </button>
                                </form>

                                <p class="cart-item-unit-price">{{ number_format($price, 2, ',', ' ') }} € / pcs</p>
                                <p class="cart-item-total-price">{{ number_format($lineTotal, 2, ',', ' ') }} €</p>

                                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="remove-button" aria-label="Remove Product from Cart">
                                        <svg class="remove-icon" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M6 6l12 12"></path>
                                            <path d="M18 6L6 18"></path>
                                        </svg>
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                </section>

                @php
                    $hasOutOfStock = $cartItems->contains(function ($item) {
                        $product = data_get($item, 'product');
                        $quantity = (int) data_get($item, 'quantity', 1);
                        return (int) data_get($product, 'quantity', 0) < $quantity;
                    });
                @endphp

                <aside class="order-summary" aria-labelledby="summary-heading">
                    <h2 id="summary-heading" class="order-summary-title">Order summary</h2>

                    <div class="duck-note">
                        <span class="duck-note-icon">
                            <svg viewBox="0 0 680 400" xmlns="http://www.w3.org/2000/svg">
                                <ellipse cx="330" cy="300" rx="110" ry="80" fill="currentColor"/>
                                <ellipse cx="220" cy="280" rx="40" ry="30" fill="currentColor"/>
                                <circle cx="400" cy="195" r="55" fill="currentColor"/>
                                <rect x="448" y="188" width="45" height="20" rx="10" fill="currentColor"/>
                                <circle cx="418" cy="183" r="10" fill="white"/>
                                <path d="M235 310 Q310 270 400 305" fill="none" stroke="white" stroke-width="10" stroke-linecap="round"/>
                                <rect x="360" y="235" width="55" height="40" fill="currentColor"/>
                            </svg>
                        </span>

                        <div>
                            <div class="duck-note-title">Your ducks are almost home</div>
                            <div class="duck-note-text">Just one more step</div>
                        </div>
                    </div>

                    <hr class="summary-divider">

                    <dl class="summary-totals">
                        <dt>Total</dt>
                        <dd>{{ number_format($subtotal, 2, ',', ' ') }} €</dd>
                    </dl>

                    <div class="order-summary_buttons">
                        <a href="{{ url('/') }}" class="back-button">Back</a>
                        @if ($hasOutOfStock)
                            <span class="continue-button disabled" style="opacity:0.5; cursor:not-allowed;" title="Remove out of stock items to continue">Continue</span>
                        @else
                            <a href="{{ route('cart.shipping') }}" class="continue-button">Continue</a>
                        @endif
                    </div>
                </aside>
            </section>
        @endif
    </main>

@endsection

