@extends('layouts.app')

@push('styles')
    @vite([
        'resources/css/user_style.css'
    ])
@endpush

@section('title', '- My Account')

@section('content')
    <main class="container py-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                Please check the form and try again.
            </div>
        @endif

        <form class="row justify-content-center g-3" action="{{ route('account.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-12 col-md-6 col-lg-4">
                <div class="p-4 h-100 bg-light border rounded">

                    <h2 class="h4 mb-3">Account details</h2>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control bg-light" value="{{ $userInfo->email_address ?? '' }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="first-name" class="form-label">First Name</label>
                        <input id="first-name" name="first_name" type="text" class="form-control"
                            value="{{ old('first_name', $userInfo->first_name ?? '') }}" maxlength="50">
                        @error('first_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input id="last-name" name="last_name" type="text" class="form-control"
                            value="{{ old('last_name', $userInfo->last_name ?? '') }}" maxlength="50">
                        @error('last_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone-number" class="form-label">Phone Number</label>
                        <input id="phone-number" name="phone_number" type="text" class="form-control"
                            value="{{ old('phone_number', $userInfo->phone_number ?? '') }}" maxlength="20">
                        @error('phone_number')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="p-4 h-100 d-flex flex-column bg-light border rounded">

                    <h2 class="h4 mb-3">Address details</h2>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select id="country" name="state" class="form-select">
                            <option value="" disabled {{ old('state', $address->state ?? '') === '' ? 'selected' : '' }}>
                                Choose your country...
                            </option>
                            <option value="Slovakia" {{ old('state', $address->state ?? '') === 'Slovakia' ? 'selected' : '' }}>
                                Slovakia
                            </option>
                            <option value="Czech Republic" {{ old('state', $address->state ?? '') === 'Czech Republic' ? 'selected' : '' }}>
                                Czech Republic
                            </option>
                            <option value="Germany" {{ old('state', $address->state ?? '') === 'Germany' ? 'selected' : '' }}>
                                Germany
                            </option>
                        </select>
                        @error('state')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street-address" class="form-label">Street Address</label>
                        <input id="street-address" name="street" type="text" class="form-control"
                            value="{{ old('street', $address->street ?? '') }}" maxlength="50">
                        @error('street')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street-number" class="form-label">Street Number</label>
                        <input id="street-number" name="house_number" type="text" class="form-control"
                            value="{{ old('house_number', $address->house_number ?? '') }}" maxlength="10">
                        @error('house_number')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input id="city" name="city" type="text" class="form-control"
                            value="{{ old('city', $address->city ?? '') }}" maxlength="40">
                        @error('city')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="postal-code" class="form-label">Postal Code</label>
                        <input id="postal-code" name="postal_code" type="text" class="form-control"
                            value="{{ old('postal_code', $address->postal_code ?? '') }}" maxlength="10">
                        @error('postal_code')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100 mt-auto">
                        Save changes
                    </button>

                </div>
            </div>

        </form>

        <div class="row justify-content-center g-3 mt-1">
            <div class="col-12 col-md-6 col-lg-4 offset-lg-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </main>
@endsection