<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <x-meta.favicon />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-600 bg-gray-100 flex min-h-screen justify-center">
        <div class="w-full max-w-4xl gap-16 py-12">
            <div class="mb-8 w-full flex justify-center">
                <a href="#" class="align-middle">
                    <x-application-mark />
                </a>
            </div>
            <main class="bg-white shadow rounded-lg mx-2">
                {{ $slot }}
            </main>
        </div>

        <x-alpha-alert />
    </body>
</html>

