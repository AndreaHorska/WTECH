<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lucky Quacky @yield('title', 'Eshop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite([
        'resources/css/variables.css',
        'resources/css/header_footer.css',
        'resources/js/app.js',
    ])

    @stack('styles')

</head>
<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @stack('scripts')

</body>
</html>

@if(session('success'))
    <div id="toast" class="toast-notification success">
        {{ session('success') }}
    </div>
@endif
@if(session('warning'))
    <div id="toast" class="toast-notification warning">
        {{ session('warning') }}
    </div>
@endif
@if(session('error'))
    <div id="toast" class="toast-notification error">
        {{ session('error') }}
    </div>
@endif