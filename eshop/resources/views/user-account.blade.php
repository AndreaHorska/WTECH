@extends('layouts.app')
@push('styles')
    @vite([
        'resources/css/user_style.css'
    ])
@endpush

@section('title', '- My Account')

@section('content')
<main class="container py-4">

  <div class="row justify-content-center g-3">

    <div class="col-12 col-md-6 col-lg-4">
      <form class="p-4 bg-light border rounded h-100" action="#" method="POST">
        <h2 class="h4 mb-3">Account details</h2>

        <div class="mb-3">
          <label for="first-name" class="form-label">First Name</label>
          <input id="first-name" type="text" class="form-control" value="{{ $userInfo->first_name ?? '' }}" required>
        </div>

        <div class="mb-3">
          <label for="last-name" class="form-label">Last Name</label>
          <input id="last-name" type="text" class="form-control" value="{{ $userInfo->last_name ?? '' }}" required>
        </div>

        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <select id="country" class="form-select" required>
            <option value="" selected disabled>Choose your country...</option>
            <option value="sk">Slovakia</option>
            <option value="cz">Czech Republic</option>
            <option value="de">Germany</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="street-address" class="form-label">Street Address</label>
          <input id="street-address" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="street-number" class="form-label">Street Number</label>
          <input id="street-number" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input id="city" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="postal-code" class="form-label">Postal Code</label>
          <input id="postal-code" type="text" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">Save changes</button>
      </form>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="p-4 bg-light border rounded h-100 d-flex flex-column">
            
            <form action="#" method="POST" class="mb-auto">
                @csrf
                <h2 class="h4 mb-3">Change password</h2>

                <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input id="new-password" type="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input id="confirm-password" type="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning w-100 mb-3">Change password</button>
            </form>

            <hr>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark w-100">Logout</button>
            </form>

        </div>
    </div>
</main>
@endsection