@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/style.css'
    ])
@endpush

@section('title', '- Admin-panel')

@section('content')
<main class="main container mt-4">

  <div class="d-flex justify-content-between align-items-center">
    <h2>Admin - Products</h2>
    <a class="btn btn-primary"
      href="{{ route('admin.product.add') }}">+ Add product</a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($products as $product)
          @php $image = $product->images->first(); @endphp
          <tr>
            <td>{{ $product->id }}</td>
            <td>
              <img src="{{ asset($image?->image_path ?? 'image/duck.png') }}" width="50">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ number_format($product->price, 2, ',', ' ') }}€</td>
            <td>{{ $product->categories->pluck('name')->join(', ') }}</td>
            <td>
              <a class="btn btn-sm btn-warning" href="{{ route('admin.product.edit', $product->id) }}">Edit</a>
              <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" onclick="return confirm('Naozaj zmazať?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
    </tbody>
    </table>
  </div>

</main>
@endsection