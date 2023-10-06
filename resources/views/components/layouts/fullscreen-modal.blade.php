<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-600 bg-gray-100 flex min-h-screen justify-center">
    <div class="w-full max-w-8xl px-4 lg:px-12 my-3 md:my-12">
        {{ $slot }}
    </div>
    @livewire('notifications')
    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>
