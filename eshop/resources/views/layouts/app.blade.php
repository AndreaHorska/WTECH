<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Quacky - @yield('title', 'Eshop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite([
        'resources/css/variables.css',
        'resources/css/header_footer.css',
        'resources/js/app.js',
        'resources/js/products.js'
    ])

    @stack('styles')

    @stack('scripts')
    
</head>
<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

</body>
</html>