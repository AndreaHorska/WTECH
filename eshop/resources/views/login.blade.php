@extends('layouts.formular')

@push('styles')
    @vite([
        'resources/css/user_style.css'
    ])
@endpush

@section('title', '- Login')

@section('content')
<main class="main">
    <section class="login-window">
        <section class="logo-login-register">
            <a href="{{url('/')}}" class="logo-account">Lucky<span>Quacky</span></a>
        </section>

        <form action="{{ route('login.post') }}" method="POST" class="p-4 bg-light border rounded form-box">
            @csrf
            <h1 class="mb-3 h3">Login</h1>

            @if ($errors->any())
                <div class="alert alert-danger text-danger small">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-3">
                <label for="login-email" class="form-label">E-mail</label>
                <input name="email" type="email" class="form-control" placeholder="example@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="login-password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" minlength="8" required>
            </div>

            <button type="submit" class="btn btn-warning w-100">Login</button>

            <hr>

            <a href="{{ url('/register') }}" class="btn btn-outline-secondary w-100">
                New registration
            </a>
        </form>
    </section>
</main>
@endsection