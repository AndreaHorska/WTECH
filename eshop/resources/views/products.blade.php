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

                    @if($type->categories->isNotEmpty())
                        <div class="accessories-filter">
                            <h4 class="filter-subheading">{{ $type->name }}</h4>

                            <div class="checkbox-group {{ $type->slug === 'view' ? 'single-select' : '' }}">
                                @foreach($type->categories as $category)
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            @checked(in_array($category->id, array_map('intval', request('categories', []))))>
                                        <span>{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </section>

            <button class="filter-button">Filter</button>
        </form>
    </aside>

    <section class="product-section">

        <div class="sort-header">
            <div class="tabs">
                @php
                    $tabs = [
                        'recommended' => 'Recommended',
                        'popular' => 'Most Popular',
                        'price_asc' => 'Price: Low to High',
                        'price_desc' => 'Price: High to Low',
                    ];
                @endphp

                @foreach ($tabs as $value => $label)
                    <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $value, 'per_page' => $perPage])) }}"
                        @class(['tab', 'active' => $sort === $value])>
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="items-per-page">
                <div class="items-label">Items per page</div>
                <div class="items-options">
                    @foreach ([10, 25, 50] as $option)
                        <a href="{{ route('products.index', array_merge(request()->query(), ['sort' => $sort, 'per_page' => $option, 'page' => 1])) }}"
                            @class(['active' => $perPage === $option])>{{ $option }}</a>
                        @if (!$loop->last) / @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="product-grid">

            @forelse ($products as $product)
                <x-product-card :product="$product" />
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
