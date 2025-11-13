<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Réservations') - {{ config('app.name', 'CampusConnect') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            },
            corePlugins: {
                preflight: false,
            }
        }
        // Suppress CDN warning
        if (typeof console !== 'undefined' && console.warn) {
            const originalWarn = console.warn;
            console.warn = function(...args) {
                if (args[0] && args[0].includes('cdn.tailwindcss.com should not be used in production')) {
                    return;
                }
                originalWarn.apply(console, args);
            };
        }
    </script>

    @stack('styles')
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900">
    <div class="min-h-full">
        {{-- Navigation --}}
        <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    {{-- Logo & Brand --}}
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                                🏫 CampusConnect
                            </h1>
                        </div>
                        <div class="hidden md:block ml-6">
                            <div class="flex space-x-4">
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Module Réservations
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Links --}}
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('reservations.index') }}" 
                               class="@if(request()->routeIs('reservations.index')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Dashboard
                            </a>
                            <a href="{{ route('reservations.create') }}" 
                               class="@if(request()->routeIs('reservations.create')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Nouvelle réservation
                            </a>
                            <a href="{{ route('reservations.availability') }}" 
                               class="@if(request()->routeIs('reservations.availability')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Disponibilités
                            </a>
                            <a href="{{ route('reservations.my-reservations') }}" 
                               class="@if(request()->routeIs('reservations.my-reservations')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Mes réservations
                            </a>
                        </div>
                    </div>

                    {{-- Mobile menu button --}}
                    <div class="md:hidden">
                        <button type="button" 
                                class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                                aria-controls="mobile-menu" 
                                aria-expanded="false">
                            <span class="sr-only">Ouvrir le menu principal</span>
                            <i data-lucide="menu" class="h-6 w-6"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile menu --}}
            <div class="mobile-menu hidden md:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50 dark:bg-gray-800">
                    <a href="{{ route('reservations.index') }}" 
                       class="@if(request()->routeIs('reservations.index')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('reservations.create') }}" 
                       class="@if(request()->routeIs('reservations.create')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                        Nouvelle réservation
                    </a>
                    <a href="{{ route('reservations.availability') }}" 
                       class="@if(request()->routeIs('reservations.availability')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                        Disponibilités
                    </a>
                    <a href="{{ route('reservations.my-reservations') }}" 
                       class="@if(request()->routeIs('reservations.my-reservations')) bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-200 @else text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                        Mes réservations
                    </a>
                </div>
            </div>
        </nav>

        {{-- Page Header --}}
        @hasSection('header')
            <header class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Main Content --}}
        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    {{-- Scripts --}}
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>