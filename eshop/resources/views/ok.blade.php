@extends('layouts.formular')
@push('styles')
    @vite([
        'resources/css/ok.css',
    ])
@endpush

@section('title', 'Order Confirmed')

@section('content')
<main class="success-page-container">
    <div class="success-card">

        <div class="success-icon-wrapper">
            <svg class="success-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <h1 class="success-title">Thank you!</h1>
        <p class="success-text">
            Your order <strong class="order-number">#LQ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong> has been placed successfully.
            Check your email for details.
        </p>

        <div class="success-buttons">
            <a href="{{ url('/') }}" class="success-button">Back to Shop</a>

        </div>

    </div>
</main>
@endsection
