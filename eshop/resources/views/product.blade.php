@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/style.css',
        'resources/css/product_card.css'
    ])
@endpush

@push('scripts')
    @vite(['resources/js/products.js'])
@endpush

@section('title', '- product detail')

@section('content')
<main class="main_product">
<section class="product_section">

    <div class="product_gallery">
        <div class="thumbnails">
            @forelse ($product->images as $image)
                <img class="thumb {{ $loop->first ? 'active' : '' }}" src="{{ asset($image->image_path) }}" alt="thumb{{ $loop->iteration }}">
            @empty
                <img class="thumb active" src="{{ asset('image/duck.png') }}" alt="thumb1">
            @endforelse
        </div>
        <div class="main_product_box">
            <img id="mainImage" src="{{ asset($product->images->first()?->image_path ?? 'image/duck.png') }}" alt="main image">
        </div>
    </div>

    <div class="product_info">
      <h1>{{ $product->name }}</h1>
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
      <div class="description">
        {{ $product->description }}
      </div>

      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="quantity_control">
            <p>Quantity:</p>
            <input type="number" name="quantity" value="1" min="1" id="quantityInput">
        </div>
        <div class="stock-info mb-2">
            @if ($product->quantity > 5)
                <span class="text-success fw-bold fs-6 d-flex align-items-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    In stock &gt; 5
                </span>
            @elseif ($product->quantity > 0)
                <span class="text-warning fw-bold fs-6">
                    Only {{ $product->quantity }} left!
                </span>
            @else
                <span class="text-danger fw-bold fs-6">
                    Out of stock
                </span>
            @endif
        </div>
        <h1>{{ number_format($product->price, 2, ',', ' ') }}€</h1>
        <button type="submit" class="btn btn-warning px-5" {{ $product->quantity == 0 ? 'disabled' : '' }}>Add to cart</button>
    </form>
    </div>

  </section>



<section class="specification">

  <div class="left_spec">
    <h2>Specification</h2>
      <table class="spec-table">
          @foreach (\App\Models\Product::$specs as $name => $spec)
              <tr>
                  <td>{{ $spec['label'] }}</td>
                  <td>{{ $product->{$name} }}</td>
              </tr>
          @endforeach
      </table>
  </div>

  <div class="right_spec">
    <h2>Customer Review</h2>
    <p class="text-muted small">How would you rate this product?</p>

    <form action="{{ route('product.review', $product->id) }}" method="POST" class="review-form">
        @csrf
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

        <button type="submit" class="btn btn-dark w-100 fw-bold">Add review</button>
    </form>

  </div>
</section>

<section class="related_products">
  <h2 class="mb-4 h3">Similar Products</h2>

  <div class="product-grid">

        @foreach ($similar as $item)
          <x-product-card :product="$item" />
        @endforeach

        </div>

  </div>
</section>
</main>
@endsection
