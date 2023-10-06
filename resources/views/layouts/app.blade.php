<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-600 bg-gray-100 flex min-h-screen justify-center">
        <div class="w-full max-w-7xl px-4 xl:flex gap-16 my-3 md:my-12">
            <div class="w-72 shrink-0">
                @livewire('navigation-menu')
            </div>
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>

{{--        @livewire('livewire-ui-modal')--}}
    </body>
</html>
