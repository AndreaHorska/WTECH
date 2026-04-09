@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/product_card.css',
        'resources/css/products.css'
    ])
@endpush
@push('scripts')
    @vite(['resources/js/products.js'])
    @vite(['resources/js/filter.js'])
@endpush

@section('title', 'Products')

@section('content')

<main class="main-content">
    <aside class="sidebar">
        <h2 class="filter-title">Filter</h2>

        <section class="filter-section">
            <h3 class="filter-section-title">Price</h3>
            <div class="slider" id="slider">
                <div class="track"></div>
                <div class="progress" id="progress"></div>
                <div class="handle" id="minHandle"></div>
                <div class="handle" id="maxHandle"></div>
            </div>
            <div class="price-inputs">
                <label for="minInput" class="visually-hidden">Minimum Price</label>
                <input type="number" value="12" min="0" max="200" class="price-input" id="minInput">
                <label for="maxInput" class="visually-hidden">Maximum Price</label>
                <input type="number" value="132" min="0" max="200" class="price-input" id="maxInput">
            </div>
        </section>

        <section class="filter-section">
            <h3 class="filter-section-title">Star Rating (min.)</h3>
            <div class="stars-filter" id="starRating">
                <svg style="display:none;">
                    <symbol id="star-icon" viewBox="0 0 24 24">
                        <path d="M12 2l3 7 7 .5-5.5 4.5 1.5 7-6-4-6 4 1.5-7L2 9.5 9 9z"/>
                    </symbol>
                </svg>

                <div class="stars-filter">
                    <svg class="star-filter" data-value="1"><use href="#star-icon"></use></svg>
                    <svg class="star-filter" data-value="2"><use href="#star-icon"></use></svg>
                    <svg class="star-filter" data-value="3"><use href="#star-icon"></use></svg>
                    <svg class="star-filter" data-value="4"><use href="#star-icon"></use></svg>
                    <svg class="star-filter" data-value="5"><use href="#star-icon"></use></svg>
                </div>
            </div>
        </section>

        <section class="filter-section">
            <h3 class="filter-section-title">Accessories</h3>
            <div class="accessories-filter">
                <h4 class="filter-subheading">Outfits</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label"><input type="checkbox"><span>Hats</span></label>
                    <label class="checkbox-label"><input type="checkbox" checked><span>Glasses</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Tie</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>T-Shirt</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Jacket</span></label>
                </div>
            </div>
            <div class="accessories-filter">
                <h4 class="filter-subheading">Professions</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label"><input type="checkbox"><span>Student</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Scientist</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>White Collar</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Other</span></label>
                </div>
            </div>
            <div class="accessories-filter">
                <h4 class="filter-subheading">Gear</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label"><input type="checkbox"><span>Weapons</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Tools</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>School</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>Sports</span></label>
                    <label class="checkbox-label"><input type="checkbox"><span>DIY</span></label>
                </div>
            </div>
        </section>
        <button class="filter-button">Filter</button>
    </aside>

    <section class="product-section">

        <div class="sort-header">
            <div class="tabs">
                <a href="{{ route('products.index', ['sort' => 'recommended', 'per_page' => $perPage]) }}"
                   class="tab {{ $sort === 'recommended' ? 'active' : '' }}">
                    Recommended
                </a>

                <a href="{{ route('products.index', ['sort' => 'popular', 'per_page' => $perPage]) }}"
                   class="tab {{ $sort === 'popular' ? 'active' : '' }}">
                    Most Popular
                </a>

                <a href="{{ route('products.index', ['sort' => 'price_asc', 'per_page' => $perPage]) }}"
                   class="tab {{ $sort === 'price_asc' ? 'active' : '' }}">
                    Price: Low to High
                </a>

                <a href="{{ route('products.index', ['sort' => 'price_desc', 'per_page' => $perPage]) }}"
                   class="tab {{ $sort === 'price_desc' ? 'active' : '' }}">
                    Price: High to Low
                </a>
            </div>

            <div class="items-per-page">
                <div class="items-label">Items per page</div>
                <div class="items-options">
                    <a href="{{ route('products.index', ['sort' => $sort, 'per_page' => 10]) }}">10</a> /
                    <a href="{{ route('products.index', ['sort' => $sort, 'per_page' => 25]) }}">25</a> /
                    <a href="{{ route('products.index', ['sort' => $sort, 'per_page' => 50]) }}">50</a> /
                    <a href="{{ route('products.index', ['sort' => $sort, 'per_page' => 100]) }}">100</a>
                </div>
            </div>
        </div>

        <div class="product-grid">

        @forelse ($products as $product)
            @php
                $image = $product->images->first();
            @endphp

            <article class="product-card" data-href="{{ url('/product') }}" data-rating="{{ $product->rating }}" data-reviews="{{ $product->review_count }}">

                <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $product->name }}" class="product-image">

                <div class="product-rating" aria-label="Rated {{ $product->rating }} out of 5 stars">
                    <div class="stars" aria-hidden="true">
                        <div class="stars-base">★★★★★</div>
                        <div class="stars-fill">★★★★★</div>
                    </div>

                    <p class="rating-text">
                        <span class="rating-number">
                            {{ number_format($product->rating, 1, ',', ' ') }}
                        </span>
                        <span class="rating-count">
                            {{ $product->review_count }}x
                        </span>
                    </p>
                </div>

                <h3 class="product-title">{{ $product->name }}</h3>

                <p class="product-price">
                    {{ number_format($product->price, 2, ',', ' ') }}€
                </p>

                <button class="add-to-cart" type="button" aria-label="Add product to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="18" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Add to cart</span>
                </button>
            </article>

        @empty
            <p>No products found.</p>
        @endforelse

        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
        </div>


    </section>


</main>
@endsection
