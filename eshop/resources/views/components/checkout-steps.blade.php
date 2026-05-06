@props(['active'])

@php
$steps = [
1 => 'Cart',
2 => 'Shipping & Payment',
3 => 'Customer Info',
];
@endphp

<nav class="checkout-steps" aria-label="Checkout steps">
    <ol class="checkout-steps-list">
        @foreach($steps as $number => $label)
        <li class="checkout-step {{ $active == $number ? 'active' : '' }}">
            <span class="checkout-step-circle">{{ $number }}</span>
            <span class="checkout-step-label">{{ $label }}</span>
        </li>
        @endforeach
    </ol>
</nav>
