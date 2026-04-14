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
    <div class="sales">
        <span class="sale-big">-50%</span>
        <span class="sale-text">SALE</span>
    </div>
</section>

<section class="category-box">
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'funny']) }}'">Funny</div>
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'luxurious']) }}'">Luxurious</div>
    <div class="category" onclick="location.href='{{ route('products.index', ['main' => 'seasonal']) }}'">Seasonal</div></section>

<section class="products-box">
    <h2 class="mb-4 h3">New Arrivals</h2>
    <div class="product-grid">

        @foreach ($products as $product)
            @php $image = $product->images->first(); @endphp
            <article class="product-card" data-href="{{ route('product.show', $product->id) }}" data-rating="{{ $product->rating }}" data-reviews="{{ $product->review_count }}">
                <img src="{{ $image ? asset($image->image_path) : asset('image/duck.png') }}" alt="{{ $product->name }}" class="product-image">
                <div class="product-rating" aria-label="Rated {{ $product->rating }} out of 5 stars">
                    <div class="stars" aria-hidden="true">
                        <div class="stars-base">★★★★★</div>
                        <div class="stars-fill" style="width: {{ ($product->rating / 5) * 100 }}%">★★★★★</div>
                    </div>
                    <p class="rating-text">
                        <span class="rating-number">{{ number_format($product->rating, 1, ',', ' ') }}</span>
                        <span class="rating-count">{{ $product->review_count }}x</span>
                    </p>
                </div>
                <h3 class="product-title">{{ $product->name }}</h3>
                <p class="product-price">{{ number_format($product->price, 2, ',', ' ') }}€</p>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button class="add-to-cart" type="submit" aria-label="Add product to cart">
                        <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="18" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span>Add to cart</span>
                    </button>
                </form>
            </article>
        @endforeach

    </div>
</section>
</main>
@endsection
