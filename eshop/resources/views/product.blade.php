@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/style.css',
        'resources/css/product_card.css'
    ])
@endpush

@section('title', 'Lucky Quacky')

@section('content')
<main class="main_product">
<section class="product_section">

    <div class="product_gallery">
      <div class="thumbnails">
        <img class="thumb active" src="{{ asset('image/duck1.png') }}" alt="">
        <img class="thumb" src="{{ asset('image/duck2.png') }}" alt="">
        <img class="thumb" src="{{ asset('image/duck3.png') }}" alt="">
      </div>
      <div class="main_product_box">
        <img id="mainImage" src="{{ asset('image/duck1.png') }}" alt="main image">
      </div>
    </div>

    <div class="product_info">
      <h1>Super-duper Duck</h1>
      <div class="product-rating" aria-label="Rated 5 out of 5 stars">
            <div class="stars" aria-hidden="true">
                <div class="stars-base">★★★★★</div>
                <div class="stars-fill">★★★★★</div>
            </div>

            <p class="rating-text">
                <span class="rating-number">4.7</span>
                <span class="rating-count">214x</span>
            </p>
      </div>
      <div class="description">
        Bring some "quack" to your life! This premium vinyl sticker
        is perfect for personalizing your laptop, water bottle, 
        phone case, or notebook.
      </div>

      <p>20pcs in one package</p>

      <div class="quantity_control">
        <p>Quantity:</p>
        <input type="number" value="1" min="1" id="quantityInput">
      </div>

      <div class="stock-info mb-2">
        <span class="text-success fw-bold fs-6 d-flex align-items-center">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            In stock &gt; 5
        </span>
      </div>

      <h1>12,99€</h1>
      <button class="btn btn-warning w-100">Add to cart</button>
    </div>

  </section>



<section class="specification">
  
  <div class="left_spec">
    <h2>Specification</h2>
    <table class="spec-table">
      <tr>
        <td>Material</td>
        <td>Vinyl</td>
      </tr>
      <tr>
        <td>Size</td>
        <td>10 cm</td>
      </tr>
      <tr>
        <td>Weight</td>
        <td>100 g</td>
      </tr>
      <tr>
        <td>Color</td>
        <td>Yellow</td>
      </tr>
      <tr>
        <td>Age</td>
        <td>3+</td>
      </tr>
      <tr>
        <td>Country of origin</td>
        <td>Slovakia</td>
      </tr>
    </table>
  </div>

  <div class="right_spec">
    <h2>Customer Review</h2>
    <p class="text-muted small">How would you rate this product?</p>

    <form action="#" method="POST" class="review-form">
        <div class="star-rating-input mb-3">
            <input type="radio" id="star5" name="rating" value="5" required>
            <label for="star5" title="5 stars">★</label>
            
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4" title="4 stars">★</label>
            
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3" title="3 stars">★</label>
            
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2" title="2 stars">★</label>
            
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1" title="1 star">★</label>
        </div>

        <button type="button" class="btn btn-dark w-100 fw-bold">Add review</button>
    </form>

  </div>
</section>

<section class="related_products">
  <h2 class="mb-4 h3">Similar Products</h2>

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

        </div>

  </div>
</section>
</main>
@endsection