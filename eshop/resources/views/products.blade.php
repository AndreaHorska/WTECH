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
        <form method="GET" action="{{ route('products.index') }}" id="filterForm">
            {{-- zober aktualne nastavenia z url --}}
            @if(request('main'))
                <input type="hidden" name="main" id="mainCategory" value="{{ request('main') }}">
            @endif
            <input type="hidden" name="sort" value="{{ request('sort', 'recommended') }}">
            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
            <input type="hidden" name="query" value="{{ request('query', '') }}">
            <input type="hidden" name="rating" id="ratingInput" value="{{ request('rating', 1) }}">

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
                    <input type="number" value="{{ request('min_price', $dbMinPrice) }}" min="{{ $dbMinPrice }}" max="{{ $dbMaxPrice }}" class="price-input" id="minInput" name="min_price">
                    <label for="maxInput" class="visually-hidden">Maximum Price</label>
                    <input type="number" value="{{ request('max_price', $dbMaxPrice ) }}" min="{{ $dbMinPrice }}" max="{{ $dbMaxPrice }}" class="price-input" id="maxInput" name="max_price">
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

                @foreach($categoryTypes as $type)
                    <div class="accessories-filter">
                        <h4 class="filter-subheading">{{ $type->name }}</h4>

                        <div class="checkbox-group">
                            @foreach($type->categories as $category)
                                <label class="checkbox-label">
                                    <input type="checkbox" name="categories[]" value="{{ $category->slug }}"
                                        @checked(in_array($category->slug, request('categories', [])))>
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </section>

            <button class="filter-button">Filter</button>
        </form>
    </aside>

    <section class="product-section">

        <div class="sort-header">
            <div class="tabs">
                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'recommended', 'per_page' => $perPage])) }}"
                    @class(['tab', 'active' => $sort === 'recommended'])>
                    Recommended
                </a>

                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'popular', 'per_page' => $perPage])) }}"
                    @class(['tab', 'active' => $sort === 'popular'])>
                    Most Popular
                </a>

                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_asc', 'per_page' => $perPage])) }}"
                    @class(['tab', 'active' => $sort === 'price_asc'])>
                    Price: Low to High
                </a>

                <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => 'price_desc', 'per_page' => $perPage])) }}"
                    @class(['tab', 'active' => $sort === 'price_desc'])>
                    Price: High to Low
                </a>
            </div>

            <div class="items-per-page">
                <div class="items-label">Items per page</div>
                <div class="items-options">
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $sort, 'per_page' => 10])) }}"
                        @class(['active' => $perPage === 10])>10</a> /
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $sort, 'per_page' => 25])) }}"
                        @class(['active' => $perPage === 25])>25</a> /
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $sort, 'per_page' => 50])) }}"
                        @class(['active' => $perPage === 50])>50</a> /
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $sort, 'per_page' => 100])) }}"
                        @class(['active' => $perPage === 100])>100</a>
                </div>
            </div>
        </div>

        <div class="product-grid">

            @forelse ($products as $product)
                @php
                    $image = $product->images->first();
                @endphp

                <article class="product-card" data-href="{{ route('product.show', $product->id) }}" data-rating="{{ $product->rating }}" data-reviews="{{ $product->review_count }}">

                    <img src="{{  $image ? asset($image->image_path) : asset('image/duck.png')  }}" alt="{{ $product->name }}" class="product-image">

                    <div class="product-rating" aria-label="Rated {{ $product->rating }} out of 5 stars">
                        <div class="stars" aria-hidden="true">
                            <div class="stars-base">★★★★★</div>
                            <div class="stars-fill" style="width: {{ ($product->rating / 5) * 100 }}%">★★★★★</div>
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

            @empty
                <p>No products found.</p>
            @endforelse

        </div>

        <div class="pagination-wrapper">
            {{ $products->links('pagination.custom') }}
        </div>

    </section>


</main>
@endsection
