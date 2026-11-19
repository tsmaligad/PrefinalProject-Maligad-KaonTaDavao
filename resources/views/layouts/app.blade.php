<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Kaon Ta! Davao – Maligad's Food Guide")</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-amber-50 text-stone-800">
    @include('partials.nav')

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @include('partials.flash')
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-amber-200 bg-white py-8 text-center text-sm text-stone-500">
        Kaon Ta! Davao – Maligad's Food Guide
    </footer>
</body>
</html>
