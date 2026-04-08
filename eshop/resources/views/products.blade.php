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
                <button class="tab">Recommended</button>
                <button class="tab active">Most Popular</button>
                <button class="tab">Price: Low to High</button>
                <button class="tab">Price: High to Low</button>
            </div>

            <div class="items-per-page">
                <div class="items-label">Items per page</div>
                <div class="items-options">
                    <a href="#">10</a> /
                    <a href="#">25</a> /
                    <a href="#">50</a> /
                    <a href="#">100</a>
                </div>
            </div>
        </div>

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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="18" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Add to cart</span>
                </button>
            </article>

            <article class="product-card" data-href="{{ url('/product') }}" data-rating="4.5" data-reviews="25">
                <img src="{{ asset('image/duck1.png') }}" alt="Duck with Sunglasses" class="product-image">

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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
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

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="18" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Add to cart</span>
                </button>
            </article>

            <article class="product-card" data-href="{{ url('/product') }}" data-rating="5" data-reviews="4">
                <img src="{{ asset('image/travel_duck.png') }}" alt="Duck" class="product-image">

                <div class="product-rating" aria-label="Rated 5 out of 5 stars">
                    <div class="stars" aria-hidden="true">
                        <div class="stars-base">★★★★★</div>
                        <div class="stars-fill">★★★★★</div>
                    </div>

                    <p class="rating-text">
                        <span class="rating-number">5</span>
                        <span class="rating-count">4x</span>
                    </p>
                </div>

                <h3 class="product-title">Travel Duck</h3>

                <p class="product-price">4,85€</p>

                <button class="add-to-cart" type="button" aria-label="Add duck to cart">
                    <svg class="cart-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="18" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h7.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span>Add to cart</span>
                </button>
            </article>

        </div>


        <nav class="pagination" aria-label="Pagination">
            <a href="?page=1" class="page-link" aria-label="Previous page">&lt;</a>
            <a href="?page=1" class="page-link">1</a>
            <a href="?page=2" class="page-link active" aria-current="page">2</a>
            <a href="?page=3" class="page-link">3</a>
            <span class="page-ellipsis">...</span>
            <a href="?page=14" class="page-link">14</a>
            <a href="?page=15" class="page-link">15</a>
            <a href="?page=3" class="page-link" aria-label="Next page">&gt;</a>
        </nav>

    </section>


</main>
@endsection
