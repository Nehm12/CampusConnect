{{-- resources/views/layouts/partials/navbar.blade.php --}}
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ auth()->check() ? route('dashboard') : route('welcome') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-bold text-xl">CC</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                        Campus<span class="text-blue-600">Connect</span>
                    </span>
                </a>
            </div>

            @auth
                {{-- Navigation pour utilisateurs connectés --}}
                <div class="flex items-center space-x-4">
                    
                    {{-- Notifications --}}
                    <button class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- Dropdown Profile --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button 
                            @click="open = !open"
                            class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition-all duration-200"
                        >
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->firstname ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->lastname ?? 'S', 0, 1)) }}
                            </div>
                            
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                                </div>
                                <div class="text-xs text-gray-500 capitalize">
                                    {{ auth()->user()->role }}
                                </div>
                            </div>

                            <svg 
                                class="w-4 h-4 text-gray-500 transition-transform duration-200"
                                :class="{ 'rotate-180': open }"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div 
                            x-show="open"
                            x-transition
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2"
                            style="display: none;"
                        >
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>

                            <div class="py-2">
                                <a 
                                    href="{{ route(auth()->user()->role . '.dashboard') }}" 
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                >
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Tableau de bord
                                </a>

                                <a 
                                    href="{{ route(auth()->user()->role . '.profil') }}" 
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors"
                                >
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Mon profil
                                </a>
                            </div>

                            <div class="border-t border-gray-100 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button 
                                        type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors"
                                    >
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                {{-- Navigation pour invités --}}
                <div class="flex items-center space-x-8">
                    {{-- Navigation Desktop --}}
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600' : '' }}">
                            Accueil
                        </a>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-blue-600' : '' }}">
                            À propos
                        </a>
                        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">
                            Contact
                        </a>
                    </div>

                    {{-- Boutons Connexion/Inscription Desktop --}}
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Inscription
                        </a>
                    </div>

                    {{-- Burger Menu Mobile --}}
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600 rounded-lg p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Mobile Menu --}}
                <div id="mobile-menu" class="hidden md:hidden absolute top-16 left-0 right-0 bg-white shadow-lg border-t border-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <div class="flex flex-col space-y-3">
                            <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('welcome') ? 'text-blue-600 bg-blue-50' : '' }}">
                                Accueil
                            </a>
                            <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50' : '' }}">
                                À propos
                            </a>
                            <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : '' }}">
                                Contact
                            </a>
                            <div class="border-t border-gray-200 pt-3 mt-2"></div>
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 hover:bg-blue-50 font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 text-center transition-colors duration-200">
                                Inscription
                            </a>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>

@guest
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                const isClickInside = mobileMenuButton.contains(event.target) || mobileMenu.contains(event.target);
                
                if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }
            });
        }
    });
</script>
@endguest

@once
    @push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce