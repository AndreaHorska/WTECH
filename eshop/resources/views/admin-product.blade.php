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

@section('title', $product ? '- edit-product' : '- add-product')

@section('content')
    <main class="main_product">
        <form action="{{ $product ? route('admin.product.update', $product->id) : route('admin.product.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if ($product) @method('PUT') @endif

            <section class="product_section">

                <div class="product_gallery">
                    <div class="thumbnails">
                        @if ($product)
                            @forelse ($product->images as $image)
                                <div class="thumb-wrapper">
                                    <img class="thumb {{ $loop->first ? 'active' : '' }}" src="{{ asset($image->image_path) }}" alt="Product image {{ $loop->iteration }}">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="del_{{ $image->id }}" style="display:none">
                                    <button type="button" class="thumb-delete" onclick="document.getElementById('del_{{ $image->id }}').checked = true;
                                this.closest('.thumb-wrapper').style.display = 'none';">×</button>
                                </div>
                            @empty
                                <img class="thumb active" src="{{ asset('image/upload-placeholder.png') }}" alt="thumb1">
                            @endforelse
                        @endif
                        <div class="thumb border border-gray add-thumb" onclick="document.getElementById('newImageInput').click()">+</div>
                        @error('images')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="file" id="newImageInput" name="images[]" hidden>
                    <div class="main_product_box">
                        <img id="mainImage" src="{{ asset($product?->images->first()?->image_path ?? 'image/upload-placeholder.png') }}" alt="main image">
                    </div>
                </div>
                

                <div class="product_info">
                    <label>Product name</label>
                    <input type="text" class="form-control" name="name" placeholder="Product Name"
                           value="{{ old('name', $product->name ?? '') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror

                    <label>Description</label>
                    <textarea class="form-control description" name="description"
                              placeholder="Information about the product" maxlength="1000" required>{{ old('description', $product->description ?? '') }}</textarea>

                    <div class="quantity_control">
                        <p>Stock:</p>
                        <input type="number" class="form-control quant-control" name="quantity"
                               value="{{ old('quantity', $product->quantity ?? '') }}" required>
                    </div>
                    @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror

                    <label>Price (€)</label>
                    <input type="text" class="form-control" name="price" placeholder="0.00"
                           value="{{ old('price', $product->price ?? '') }}" required>
                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror

                    @foreach ($categoryTypes as $type)
                        <p class="fw-bold mb-1">{{ $type->name }}</p>
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            @if ($type->name == 'View')
                                <select name="categories[]" class="form-select">
                                    <option value="">-- Select --</option>
                                    @foreach ($type->categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('categories', $product?->categories->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
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
                                            {{ in_array($category->id, old('categories', $product?->categories->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat_{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @if ($type->name == 'Main')
                            @error('categories')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        @endif
                    @endforeach
                </div>
            </section>

            <section class="specification">
                <div class="left_spec">
                    <h2>Specification</h2>
                    <table class="spec-table">
                        @foreach (\App\Models\Product::$specs as $name => $spec)
                            <tr>
                                <td class="spec-label-cell">{{ $spec['label'] }}</td>
                                <td><input type="{{ $spec['type'] ?? 'text' }}" class="form-control" name="{{ $name }}"
                                           value="{{ old($name, $product->{$name} ?? '') }}"
                                           required></td>
                            </tr>
                            @error($name)
                            <tr><td colspan="2"><small class="text-danger">{{ $message }}</small></td></tr>
                            @enderror
                        @endforeach
                    </table>
                </div>

                <div class="right_spec admin">
                    <div>
                        <h2>Make it legendary</h2>
                        <div class="duck-note">
                            <span class="duck-note-icon">
                                <svg viewBox="0 0 680 400" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse cx="330" cy="300" rx="110" ry="80" fill="currentColor"/>
                                    <ellipse cx="220" cy="280" rx="40" ry="30" fill="currentColor"/>
                                    <circle cx="400" cy="195" r="55" fill="currentColor"/>
                                    <rect x="448" y="188" width="45" height="20" rx="10" fill="currentColor"/>
                                    <circle cx="418" cy="183" r="10" fill="white"/>
                                    <path d="M235 310 Q310 270 400 305" fill="none" stroke="white" stroke-width="10" stroke-linecap="round"/>
                                    <rect x="360" y="235" width="55" height="40" fill="currentColor"/>
                                </svg>
                            </span>

                            <div>
                                <div class="duck-note-title">Every great duck starts here!</div>
                                <div class="duck-note-text">So chop-chop, make those sales pop,<br>legends aren’t made by accident.</div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success">
                        {{ $product ? 'Save changes' : 'Add product' }}
                    </button>
                </div>
            </section>

        </form>
    </main>
@endsection
