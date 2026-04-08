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
      href="{{ url('/admin-add-product') }}">+ Add product</a>
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
        <tr>
          <td>1</td>
          <td><img src="image/duck_with_sunglasses.png" width="50"></td>
          <td>Duck with Sunglasses</td>
          <td>12.99€</td>
          <td>Funny</td>
          <td>
            <a class="btn btn-sm btn-warning"
                href="{{ url('/admin-edit-product') }}">Edit</a>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>

        <tr>
          <td>2</td>
          <td><img src="image/duck2.png" width="50"></td>
          <td>Luxury Duck</td>
          <td>50€</td>
          <td>Luxurious</td>
          <td>
            <a class="btn btn-sm btn-warning"
                href="{{ url('/admin-edit-product') }}">Edit</a>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>

        <tr>
          <td>3</td>
          <td><img src="image/duck1.png" width="50"></td>
          <td>Funny Duck</td>
          <td>10€</td>
          <td>Luxurious</td>
          <td>
            <a class="btn btn-sm btn-warning"
                href="{{ url('/admin-edit-product') }}">Edit</a>
            <button class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

</main>
@endsection