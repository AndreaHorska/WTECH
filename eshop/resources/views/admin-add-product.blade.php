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
            <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ old('name') }}" maxlength="80" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Description</label>
            <textarea class="form-control description" name="description" placeholder="Information about the product" maxlength="1000" required>{{ old('description') }}</textarea>

            <div class="quantity_control">
                <p>Stock:</p>
                <input type="number" class="form-control quant-control" name="quantity" value="{{ old('quantity') }} required">
            </div>
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Price (€)</label>
            <input type="text" class="form-control" name="price" placeholder="0.00" value="{{ old('price') }}" maxlength="9" required>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror

            @foreach ($categoryTypes as $type)
                <p class="fw-bold mb-1">{{ $type->name }}</p>
                <div class="d-flex flex-wrap gap-3 mb-2">
                    @if ($type->name == 'View')
                        <select name="categories[]" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach ($type->categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
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
                                    id="cat_{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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
                    <td><input type="text" class="form-control" name="material" value="{{ old('material') }}" maxlength="100" required></td>
                </tr>
                @error('material') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Size" disabled></td>
                    <td><input type="text" class="form-control" name="size" value="{{ old('size') }}" maxlength="50" required></td>
                </tr>
                @error('size') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Weight" disabled></td>
                    <td><input type="text" class="form-control" name="weight" value="{{ old('weight') }}" maxlength="30" required></td>
                </tr>
                @error('weight') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Age" disabled></td>
                    <td><input type="text" class="form-control" name="age" value="{{ old('age') }}" maxlength="30" required></td>
                </tr>
                @error('age') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Country of origin" disabled></td>
                    <td><input type="text" class="form-control" name="country_of_origin" value="{{ old('country_of_origin') }}" maxlength="60" required></td>
                </tr>
                @error('country_of_origin') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
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

    <div class="d-flex justify-content-center">
        <button class="btn btn-success w-50 mt-2 mb-3">
            Add product
        </button>
    </div>

    </form>

</main>
@endsection