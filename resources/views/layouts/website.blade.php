<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet" />
    <!-- icon button floatting -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon.env
    ?family=Material+Icons'>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-roboto antialiased">
    <div class="min-h-screen bg-fixed bg-right">
        <x-website.banner />
        <x-website.menu />
        <main class="bg-white mx-auto mt-1 max-w-7xl">
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </main>
        <x-website.footer />
    </div>
    @stack('scripts_bottom')
</body>

</html>
