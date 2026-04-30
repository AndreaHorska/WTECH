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
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <section class="product_section">

        <div class="product_gallery">
            <div class="thumbnails">
                @forelse ($product->images as $image)
                    <div class="thumb-wrapper">
                        <img class="thumb {{ $loop->first ? 'active' : '' }}" src="{{ asset($image->image_path) }}" alt="thumb{{ $loop->iteration }}">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="del_{{ $image->id }}" style="display:none">
                        <button type="button" class="thumb-delete" onclick="document.getElementById('del_{{ $image->id }}').checked = true;
                            this.closest('.thumb-wrapper').style.display = 'none';">×</button>
                    </div>
                @empty
                    <img class="thumb active" src="{{ asset('image/duck.png') }}" alt="thumb1">
                @endforelse
                <div class="thumb border border-gray add-thumb" onclick="document.getElementById('newImageInput').click()">+</div>
            </div>
            <input type="file" id="newImageInput" name="images[]" hidden>
            <div class="main_product_box">
                <img id="mainImage" src="{{ asset($product->images->first()?->image_path ?? 'image/duck.png') }}" alt="main image">
            </div>
        </div>

        <div class="product_info">

            <label>Product name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Description</label>
            <textarea class="form-control description" name="description">{{ old('description', $product->description) }}</textarea>

            <label>Pcs in one package</label>
            <input type="number" class="form-control" name="pcs" value="10">

            <div class="quantity_control">
                <p>Stock:</p>
                <input type="number" class="form-control quant-control" name="quantity" value="{{ old('quantity', $product->quantity) }}">
            </div>
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Price (€)</label>
            <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Categories</label>
            @foreach ($categoryTypes as $type)
                <p class="fw-bold mb-1">{{ $type->name }}</p>
                <div class="d-flex flex-wrap gap-3 mb-2">
                    @if ($type->name == 'View')
                        <select name="categories[]" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach ($type->categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                    <td><input type="text" class="form-control" name="material" value="{{ old('material', $product->material) }}"></td>
                </tr>
                @error('material') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Size" disabled></td>
                    <td><input type="text" class="form-control" name="size" value="{{ old('size', $product->size) }}"></td>
                </tr>
                @error('size') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Weight" disabled></td>
                    <td><input type="text" class="form-control" name="weight" value="{{ old('weight', $product->weight) }}"></td>
                </tr>
                @error('weight') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Age" disabled></td>
                    <td><input type="text" class="form-control" name="age" value="{{ old('age', $product->age) }}"></td>
                </tr>
                @error('age') <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr> @enderror
                <tr>
                    <td><input type="text" class="form-control" value="Country of origin" disabled></td>
                    <td><input type="text" class="form-control" name="country_of_origin" value="{{ old('country_of_origin', $product->country_of_origin) }}"></td>
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

    <button class="btn btn-success w-100 mt-3 mb-3">Save changes</button>

    </form>

</main>
@endsection