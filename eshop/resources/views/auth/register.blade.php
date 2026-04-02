@extends('layouts.formular')

@section('title', '- Register')

@section('content')
<main class="main">
    <section class="login-window">
        <section class="logo-login-register">
            <a href="{{ url('/') }}" class="logo-account">Lucky<span>Quacky</span></a>
        </section>

        <form action="{{ route('register') }}" method="POST" class="p-4 bg-light border rounded form-box">
            @csrf

            <h1 class="mb-3 h3">Registration</h1>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="example@email.com" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" required>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input name="password_confirmation" type="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-warning w-100">Create account</button>

            <hr>

            <a href="{{ url('/login') }}" class="btn btn-outline-secondary w-100">
                Have account? Login
            </a>
        </form>
    </section>
</main>
@endsection
