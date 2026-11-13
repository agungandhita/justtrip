<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    @include('Frontend.partials.tracking-head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex,follow" />

    <title>@yield('title', 'Gathering Kantor ke Jogja — JustTrip')</title>
    <meta name="description" content="@yield('description', 'Paket gathering kantor ke Jogja mulai Rp1 Juta-an per orang. Bus PP, hotel, makan, dokumentasi drone. Kapasitas 30 hingga 500 peserta.')" />

    <!-- Google Fonts with display=swap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Preload Hero Image -->
    <link rel="preload" as="image" href="{{ asset('image/1.webp') }}" type="image/webp">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('image/logo6.png') }}" type="image/png">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-orange-500 selection:text-white">
    @include('Frontend.partials.tracking-body')

    @yield('content')

    @stack('scripts')
</body>
</html>
