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
    <div class="about_us">
        <h2 class="about-title">Lucky Quacky</h2>
        <p class="about-text">
            Fun, stylish and unique duck stickers for everyone
        </p>
    </div>
    <div class="sales">
        <span class="sale-big">-50%</span>
        <span class="sale-text">SALE</span>
    </div>
</section>

<section class="category-box">
    <div class="category" onclick="location.href='{{ url('/products') }}'">Funny</div>
    <div class="category" onclick="location.href='{{ url('/products') }}'">Luxurious</div>
    <div class="category" onclick="location.href='{{ url('/products') }}'">Seasonal</div>
</section>

<section class="products-box">
    <h2 class="mb-4 h3">New Arrivals</h2>
    <div class="product-grid">

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="4.7" data-reviews="1756">
            <img src="{{ asset('image/duck_with_sunglasses.png') }}" alt="Duck with Sunglasses" class="product-image">
            <div class="product-rating" aria-label="Rated 4.7 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">4,7</span>
                    <span class="rating-count">1756x</span>
                </p>
            </div>
            <h3 class="product-title">Duck with Sunglasses</h3>
            <p class="product-price">147,30€</p>
            <button class="add-to-cart" type="button" aria-label="Add Duck with Sunglasses to cart">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="256">
            <img src="{{ asset('image/duck.png') }}" alt="Duck" class="product-image">
            <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">5</span>
                    <span class="rating-count">256x</span>
                </p>
            </div>
            <h3 class="product-title">Super-duper Duck</h3>
            <p class="product-price">0,30€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="6">
            <img src="{{ asset('image/duck2.png') }}" alt="Duck" class="product-image">
            <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">5</span>
                    <span class="rating-count">6x</span>
                </p>
            </div>
            <h3 class="product-title">Standing Duck</h3>
            <p class="product-price">7,20€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="37">
            <img src="{{ asset('image/rubber-duck.png') }}" alt="Duck" class="product-image">
            <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">5</span>
                    <span class="rating-count">37x</span>
                </p>
            </div>
            <h3 class="product-title">Bubble Duck</h3>
            <p class="product-price">58,62€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="4.5" data-reviews="25">
            <img src="{{ asset('image/duck1.png') }}" alt="Ducklings" class="product-image">
            <div class="product-rating" aria-label="Rated 4.5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">4.5</span>
                    <span class="rating-count">25x</span>
                </p>
            </div>
            <h3 class="product-title">Quacky Ducky</h3>
            <p class="product-price">58,60€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="256">
            <img src="{{ asset('image/duck3.png') }}" alt="Duck" class="product-image">
            <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">5</span>
                    <span class="rating-count">256x</span>
                </p>
            </div>
            <h3 class="product-title">Quacky Quack</h3>
            <p class="product-price">147,30€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

        <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="1056">
            <img src="{{ asset('image/duckling.png') }}" alt="Ducklings" class="product-image">
            <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                <div class="stars" aria-hidden="true">
                    <div class="stars-base">★★★★★</div>
                    <div class="stars-fill">★★★★★</div>
                </div>
                <p class="rating-text">
                    <span class="rating-number">5</span>
                    <span class="rating-count">1056x</span>
                </p>
            </div>
            <h3 class="product-title">Ducklings</h3>
            <p class="product-price">4,85€</p>
            <button class="add-to-cart" type="button">
                <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="18" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                <span>Add to cart</span>
            </button>
        </article>

    </div>
</section>
</main>
@endsection