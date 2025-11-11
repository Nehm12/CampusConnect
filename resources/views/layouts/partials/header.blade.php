{{-- resources/views/layouts/partials/header.blade.php --}}
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-bold text-xl">CC</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                        Campus<span class="text-blue-600">Connect</span>
                    </span>
                </a>
            </div>

            {{-- Section droite : Notifications + Profile --}}
            <div class="flex items-center space-x-4">
                
                {{-- Notifications (optionnel) --}}
                <button class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    {{-- Badge de notification --}}
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- Dropdown Profile --}}
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    {{-- Bouton Profile --}}
                    <button 
                        @click="open = !open"
                        class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    >
                        {{-- Avatar --}}
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(auth()->user()->firstname ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->lastname ?? 'S', 0, 1)) }}
                        </div>
                        
                        {{-- Nom et rôle --}}
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                            </div>
                            <div class="text-xs text-gray-500 capitalize">
                                {{ auth()->user()->role }}
                            </div>
                        </div>

                        {{-- Chevron --}}
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

                    {{-- Dropdown Menu --}}
                    <div 
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50"
                        style="display: none;"
                    >
                        {{-- Infos utilisateur --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </div>
                        </div>

                        {{-- Menu items --}}
                        <div class="py-2">
                            @php
                                $dashboardRoute = match(auth()->user()->role) {
                                    'student' => 'etudiant.dashboard',
                                    'teacher' => 'enseignant.dashboard',
                                    'admin' => 'admin.dashboard',
                                    default => 'dashboard'
                                };
                                
                                $profileRoute = match(auth()->user()->role) {
                                    'student' => 'etudiant.profil',
                                    'teacher' => 'enseignant.profil',
                                    'admin' => 'admin.profil',
                                    default => 'dashboard'
                                };
                            @endphp
                            
                            <a 
                                href="{{ route($dashboardRoute) }}" 
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Tableau de bord
                            </a>

                            <a 
                                href="{{ route($profileRoute) }}" 
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Mon profil
                            </a>

                            <a 
                                href="#" 
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150"
                            >
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Paramètres
                            </a>
                        </div>

                        {{-- Déconnexion --}}
                        <div class="border-t border-gray-100 pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button 
                                    type="submit"
                                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150"
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
        </div>
    </div>
</nav>

{{-- Alpine.js pour le dropdown (si pas déjà inclus) --}}
@once
    @push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce