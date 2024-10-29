<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NetSavvy')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <!-- Navbar or Header Content -->
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <!-- Footer Content -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>