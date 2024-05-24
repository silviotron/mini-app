<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative text-[#222831] dark:text-[#EEEEEE] bg-[#EEEEEE] dark:bg-[#222831] min-h-screen flex flex-col p-4">

    <header class="flex items-center justify-center mb-4">
        <nav
            class="flex px-3 text-2xl font-medium  text-gray-600 dark:text-gray-200 justify-center items-center w-full bg-[#76ABAE] dark:bg-[#31363F] ">
            <a class="relative block px-6 py-4 whitespace-nowrap transition hover:text-[#31363F]  dark:hover:text-[#76ABAE] {{ request()->routeIs('home') ? 'text-[#76ABAE]' : '' }}"
                href="{{ route('home') }}">Home</a>
            <a class="relative block px-6 py-4 whitespace-nowrap transition hover:text-[#31363F]  dark:hover:text-[#76ABAE] {{ request()->routeIs('search') ? 'text-[#76ABAE]' : '' }}"
                href="{{ route('search') }}">Buscar</a>
            <a class="relative block px-6 py-4 whitespace-nowrap transition hover:text-[#31363F]  dark:hover:text-[#76ABAE] {{ request()->routeIs('historial') ? 'text-[#76ABAE]' : '' }}"
                href="{{ route('saves') }}">Guardadas</a>
        </nav>
    </header>


    <main class="p-4 bg-[#31363F] flex-grow">
        {{ $slot }}
    </main>
</body>

</html>
