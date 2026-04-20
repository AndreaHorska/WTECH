@extends('layouts.app')
@push('styles')
    @vite(['resources/css/style.css'])
@endpush

@push('scripts')
    @vite([
        'resources/js/admin.js',
        'resources/js/products.js'
    ])
@endpush

@section('title', '- add-product')

@section('content')
<main class="main_product">
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <section class="product_section">

        <div class="product_gallery">
            <div class="thumbnails">
                @forelse ($product->images as $image)
                    <img class="thumb {{ $loop->first ? 'active' : '' }}" src="{{ asset($image->image_path) }}" alt="thumb{{ $loop->iteration }}">
                @empty
                    <img class="thumb active" src="{{ asset('image/duck.png') }}" alt="thumb1">
                @endforelse
                <label class="thumb border border-gray add-thumb">
                    +
                    <input type="file" name="images[]" hidden>
                </label>
            </div>
            <div class="main_product_box">
                <img id="mainImage" src="{{ asset($product->images->first()?->image_path ?? 'image/duck.png') }}" alt="main image">
            </div>
        </div>

        <div class="product_info">

            <label>Product name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}">

            <label>Description</label>
            <textarea class="form-control description" name="description">{{ $product->description }}</textarea>

            <label>Pcs in one package</label>
            <input type="number" class="form-control" name="pcs" value="10">

            <div class="quantity_control">
                <p>Stock:</p>
                <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
            </div>

            <label>Price (€)</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">

            <label>Categories</label>
            @foreach ($categoryTypes as $type)
                <p class="fw-bold mb-1">{{ $type->name }}</p>
                <div class="d-flex flex-wrap gap-3 mb-2">
                    @foreach ($type->categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                name="categories[]" 
                                value="{{ $category->id }}"
                                id="cat_{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="cat_{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <section class="specification">

        <div class="left_spec">
            <h2>Specification</h2>

            <table class="spec-table">
                <tr>
                    <td><input type="text" class="form-control" value="Material" disabled></td>
                    <td><input type="text" class="form-control" name="material" value="{{ $product->material }}"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Size" disabled></td>
                    <td><input type="text" class="form-control" name="size" value="{{ $product->size }}"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Weight" disabled></td>
                    <td><input type="text" class="form-control" name="weight" value="{{ $product->weight }}"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Age" disabled></td>
                    <td><input type="text" class="form-control" name="age" value="{{ $product->age }}"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Country of origin" disabled></td>
                    <td><input type="text" class="form-control" name="country_of_origin" value="{{ $product->country_of_origin }}"></td>
                </tr>
            </table>
        </div>

        <div class="right_spec">
            <h2>Customer Review</h2>
            <p class="text-muted small">How would you rate this product?</p>

            <section class="review-form">
                <div class="star-rating-admin mb-3">
                    <label for="stars">★★★★★</label>
                </div>
            </section>

        </div>

    </section>

    <button class="btn btn-success w-100 mt-3 mb-3">Save changes</button>

    </form>

</main>
@endsection