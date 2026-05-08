@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/product_card.css',
        'resources/css/style.css'
    ])
@endpush
@push('scripts')
    @vite(['resources/js/products.js'])
@endpush

@section('title', '- homepage')

@section('content')
<main class="main">
<section class="top-news">
    <a class="about_us" href="{{ route('products.index') }}" >
        <h2 class="about-title">Lucky Quacky</h2>
        <p class="about-text">
            Fun, stylish and unique duck stickers for everyone
        </p>
        <p class="all_categories">See every single one of our wonderful ducks</p>
    </a>
    <a class="sales" href="{{ route('products.index') }}">
        <span class="sale-big">WORLDWIDE SHIPPING</span>
        <span class="sale-text">Your duck stickers can fly anywhere</span>
    </a>
</section>

<section class="category-box">
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'funny']) }}'">Funny</div>
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'luxurious']) }}'">Luxurious</div>
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'seasonal']) }}'">Seasonal</div></section>

<section class="products-box">
    <h2 class="mb-4 h3">New Arrivals</h2>
    <div class="product-grid">

        @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach

    </div>
</section>
</main>
@endsection
