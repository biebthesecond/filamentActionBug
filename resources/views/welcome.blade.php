<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-meta.favicon/>

    <title>{{ config('app.name', 'Laravel') }} | Gratis en beveiligd bestanden versturen</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>
<body class="antialiased">

<div class="relative bg-teal-900 overflow-hidden">
    <div class="hidden sm:block sm:absolute sm:inset-0">
        <svg
            class="absolute bottom-0 right-0 transform translate-x-1/2 mb-48 text-gray-700 lg:top-0 lg:mt-28 lg:mb-0 xl:transform-none xl:translate-x-0"
            width="364" height="384" viewBox="0 0 364 384" fill="none">
            <defs>
                <pattern id="eab71dd9-9d7a-47bd-8044-256344ee00d0" x="0" y="0" width="20" height="20"
                         patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" fill="currentColor"/>
                </pattern>
            </defs>
            <rect width="364" height="384" fill="url(#eab71dd9-9d7a-47bd-8044-256344ee00d0)"/>
        </svg>
    </div>
    <div class="relative pt-12 pb-32 sm:pt-3 sm:pb-32" x-data="{ open: false }">
        <nav class="fixed top-0 py-3 bg-teal-900 w-full z-10 mx-auto flex items-center justify-between px-4 sm:px-6">
            <div class="flex items-center flex-1">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="/" aria-label="Dashboard">
                        <img class="h-8 w-auto sm:h-10" src="{{ url('images/logo.svg') }}"
                             alt="Logo">
                    </a>
                    <a href="/" aria-label="Dashboard">
                        <span class="text-teal-400">Safe</span><span class="text-white">sent</span>
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button type="button"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-gray-700 focus:outline-none focus:bg-gray-700 transition duration-150 ease-in-out"
                                id="main-menu" aria-label="Main menu" aria-haspopup="true"
                                @click="open = !open"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                {{--                <div class="hidden space-x-10 md:flex md:ml-10">--}}
                {{--                    <a href="#" class="font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">Product</a>--}}
                {{--                    <a href="#" class="font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">Features</a>--}}
                {{--                    <a href="#" class="font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">Marketplace</a>--}}
                {{--                    <a href="#" class="font-medium text-white hover:text-gray-300 transition duration-150 ease-in-out">Company</a>--}}
                {{--                </div>--}}
            </div>
            @if (Route::has('login'))
                <div class="hidden md:flex">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-white underline">Mijn account</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:shadow-outline-teal focus:border-teal-700 active:bg-teal-700 transition duration-150 ease-in-out">Create account</a>
                        @endif

                        <a href="{{ route('login') }}"
                           class="ml-4 py-2 text-sm text-white underline">
                            Login
                        </a>
                    @endif
                </div>
            @endif
        </nav>


    </div>
</div>

</body>
</html>
