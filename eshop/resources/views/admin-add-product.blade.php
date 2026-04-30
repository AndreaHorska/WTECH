@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/style.css',
        'resources/css/admin_style.css'
    ])
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
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <section class="product_section">

        <div class="product_gallery">
            <div class="thumbnails">
                <div class="thumb border border-gray add-thumb" onclick="document.getElementById('newImageInput').click()">+</div>
            </div>
            <input type="file" id="newImageInput" name="images[]" hidden>
            <div class="main_product_box">
                <img id="mainImage" src="{{ asset('image/duck.png') }}" alt="main image">
            </div>
        </div>

        <div class="product_info">

            <label>Product name</label>
            <input type="text" class="form-control" name="name" placeholder="Product Name">

            <label>Description</label>
            <textarea class="form-control description" name="description" placeholder="Information about the product"></textarea>

            <label>Pcs in one package</label>
            <input type="number" class="form-control" name="pcs" placeholder="10">

            <div class="quantity_control">
                <p>Stock:</p>
                <input type="number" class="form-control quant-control" name="quantity">
            </div>

            <label>Price (€)</label>
            <input type="text" class="form-control" name="price" placeholder="0.00">

            <label>Categories</label>
            @foreach ($categoryTypes as $type)
                <p class="fw-bold mb-1">{{ $type->name }}</p>
                <div class="d-flex flex-wrap gap-3 mb-2">
                    @if ($type->name == 'View')
                        <select name="categories[]" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach ($type->categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        @foreach ($type->categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    id="cat_{{ $category->id }}">
                                <label class="form-check-label" for="cat_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    @endif
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
                    <td><input type="text" class="form-control" name="material"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Size" disabled></td>
                    <td><input type="text" class="form-control" name="size"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Weight" disabled></td>
                    <td><input type="text" class="form-control" name="weight"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Age" disabled></td>
                    <td><input type="text" class="form-control" name="age"></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" value="Country of origin" disabled></td>
                    <td><input type="text" class="form-control" name="country_of_origin"></td>
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

    <button class="btn btn-success w-100 mt-3 mb-3">Add product</button>

    </form>

</main>
@endsection