<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======
    <meta name="csrf-token" content="{{ csrf_token() }}">
>>>>>>> 1fbbe90 (Stiahnutie Breehze framework na prihlasovanie a registraciu)
    <title>Lucky Quacky @yield('title', 'Eshop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite([
        'resources/css/variables.css',
        'resources/css/user_style.css',
<<<<<<< HEAD
        'resources/js/app.js',
        'resources/js/products.js'
    ])

    @stack('styles')

    @stack('scripts')
    
=======
        'resources/js/app.js'
    ])

    @stack('styles')
    @stack('scripts')
>>>>>>> 1fbbe90 (Stiahnutie Breehze framework na prihlasovanie a registraciu)
</head>
<body>

    @yield('content')

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 1fbbe90 (Stiahnutie Breehze framework na prihlasovanie a registraciu)
