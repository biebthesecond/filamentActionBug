<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-meta.favicon />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <a href="/" aria-label="Home">
                        <img class="h-8 w-auto sm:h-10" src="{{ url('images/logo.svg') }}"
                             alt="Logo">
                    </a>
                    <a href="/" aria-label="Home">
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
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:shadow-outline-teal focus:border-teal-700 active:bg-teal-700 transition duration-150 ease-in-out">Account aanmaken</a>
                        @endif

                        <a href="{{ route('login') }}"
                           class="ml-4 py-2 text-sm text-white underline">
                            Login
                        </a>
                    @endif
                </div>
            @endif
        </nav>

        <!--
          Mobile menu, show/hide based on menu open state.

          Entering: "duration-150 ease-out"
            From: "opacity-0 scale-95"
            To: "opacity-100 scale-100"
          Leaving: "duration-100 ease-in"
            From: "opacity-100 scale-100"
            To: "opacity-0 scale-95"
        -->
        <div x-show="open" style="display: none" class="fixed z-20 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <div class="rounded-lg shadow-md">
                <div class="rounded-lg bg-white shadow-xs overflow-hidden" role="menu" aria-orientation="vertical"
                     aria-labelledby="main-menu">
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <div>
                            <img class="h-8 w-auto" src="{{ url('images/logo.svg') }}"
                                 alt="">
                        </div>
                        <div class="-mr-2">
                            <button type="button"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                    @click="open = false"
                                    aria-label="Close menu">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{--                    <div class="space-y-1 px-2 pt-2 pb-3">--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"--}}
                    {{--                           role="menuitem">Product</a>--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"--}}
                    {{--                           role="menuitem">Features</a>--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"--}}
                    {{--                           role="menuitem">Marketplace</a>--}}
                    {{--                        <a href="#"--}}
                    {{--                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"--}}
                    {{--                           role="menuitem">Company</a>--}}
                    {{--                    </div>--}}
                    <div>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-teal-500 underline block w-full px-5 py-3 text-center">
                                    Mijn account
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                   class="text-sm text-teal-500 underline block w-full px-5 py-3 text-center">
                                    Login
                                </a>

                                @if (Route::has('register'))
                                    <div class="px-10">
                                        <a href="{{ route('register') }}"
                                           class="inline-flex text-center items-center block w-full px-5 py-3 text-center border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:shadow-outline-teal focus:border-teal-700 active:bg-teal-700 transition duration-150 ease-in-out mb-4">Account aanmaken</a>

                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <main class="mt-8 sm:mt-16 md:mt-20 lg:mt-24">
            <div class="mx-auto max-w-screen-xl">
                <div class="lg:grid lg:grid-cols-1 lg:gap-8">
                    <div class="mt-12 sm:mt-16 lg:mt-0 lg:col-span-6">
                        <div class="bg-white sm:max-w-md sm:w-full sm:mx-auto sm:rounded-lg sm:overflow-hidden">
                            <div class="px-4 py-8 sm:px-10">
                                <div>
                                    <h1 class="text-teal-600 text-2xl text-center">Safesent</h1>
                                    <p class="text-sm leading-5 font-medium text-gray-700 inline-flex mt-4">
                                        <img src="{{ url('images/logo.svg') }}" class="h-10 w-auto mr-2 pt-1" />
                                        {{ $header }}
                                    </p>

                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 sm:px-6 sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left lg:flex lg:items-center mt-10">
                        <div>
                            <h2 class="mt-0 text-4xl tracking-tight leading-10 font-extrabold text-white sm:mt-5 sm:leading-none sm:text-6xl lg:mt-6 lg:text-5xl xl:text-6xl">
                                <span class="inline-flex">
                                    Gratis en beveiligd
                                    <svg clip="d-inline" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </span>
                                <br class="hidden md:inline">
                                <span class="text-teal-500">bestanden versturen</span>
                            </h2>
                            <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                                Gratis en veilig privacygevoelige bestanden<sup class="text-sm text-gray-400">*</sup> delen
                                was nog nooit zo eenvoudig. De boekhouder zal blij met je zijn.
                            </p>
                            <p class="text-base text-gray-400 text-sm">
                                * Maximale grootte per bestand is 100mb
                            </p>

                            <p class="mt-5 text-base text-gray-300 sm:mt-13 sm:text-xl lg:text-lg xl:text-xl">
                                Ook gratis beveiligde bestanden versturen?
                                <a href="/register" class="bg-teal-600 rounded px-3 py-2 mt-3 ml-3">
                                    Registreer nu
                                </a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<footer class="bg-white">
    <div class="max-w-screen-xl mx-auto py-12 px-4 overflow-hidden space-y-8 sm:px-6 lg:px-8">
        <p class="mt-8 text-center text-base leading-6 text-gray-400">
            &copy; 2020 {{ date('Y') <> '2020' ? '- ' . date('Y') : null }} Safesent, alle rechten voorbehouden
            - Safesent is een initiatief van <a href="https://uteq.nl" class="underline" target="_blank">uteq.nl</a>.
        </p>
    </div>
</footer>


<!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
<div class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5" x-data="{ open : true }" x-show="open">
    <div class="max-w-screen-xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="p-2 rounded-lg bg-yellow-600 shadow-lg sm:p-3">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
          <span class="flex p-2 rounded-lg bg-yellow-800">
            <!-- Heroicon name: speakerphone -->
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
            </svg>
          </span>
                    <p class="ml-3 font-medium text-white truncate">
            <span class="md:hidden">
              Vertel ons wat beter kan
            </span>
                        <span class="hidden md:inline">
              Safesent is een nieuw product. Laat ons weten wat je ervan vindt en vooral wat beter kan.
            </span>
                    </p>
                </div>
                <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                    <div class="rounded-md shadow-sm">
                        <a href="mailto:safesent@uteq.nl?subject=Safesent%20Feedback%20over%20...&body=Dit%20kan%20volgens%20mij%20beter%0A%0A..."
                           class="flex items-center justify-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-yellow-600 bg-white hover:text-yellow-500 focus:outline-none focus:shadow-outline transition ease-in-out duration-150"
                        >
                            Feedback achterlaten
                        </a>
                    </div>
                </div>
                <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                    <button type="button"
                            class="-mr-1 flex p-2 rounded-md hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500 transition ease-in-out duration-150"
                            aria-label="Dismiss"
                            @click="open = false"
                    >
                        <!-- Heroicon name: x -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<x-alpha-alert />

</body>
</html>
