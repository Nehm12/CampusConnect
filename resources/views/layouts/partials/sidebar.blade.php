{{-- resources/views/layouts/partials/sidebar.blade.php --}}
<aside 
    class="w-64 bg-gradient-to-b from-gray-50 to-white shadow-xl flex-shrink-0 hidden lg:block border-r border-gray-200"
    x-data="{ open: true }"
>
    <div class="h-full flex flex-col">
        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto py-6 px-4">
            
            @if(auth()->user()->role === 'student')
                {{-- Menu Étudiant --}}
                <div class="space-y-2">
                    <div class="mb-6">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Étudiant</h3>
                    </div>
                    
                    <a href="{{ route('etudiant.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('etudiant.dashboard') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm border-l-4 border-blue-500' 
                                 : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('etudiant.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>

                    <a href="{{ route('etudiant.annonces') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('etudiant.annonces*') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm border-l-4 border-blue-500' 
                                 : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('etudiant.annonces*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Annonces
                    </a>

                    <a href="{{ route('etudiant.salles') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('etudiant.salles') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm border-l-4 border-blue-500' 
                                 : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('etudiant.salles') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Salles & Matériels
                    </a>

                    <a href="{{ route('etudiant.profil') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('etudiant.profil') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm border-l-4 border-blue-500' 
                                 : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('etudiant.profil') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Mon Profil
                    </a>
                </div>

            @elseif(auth()->user()->role === 'teacher')
                {{-- Menu Enseignant --}}
                <div class="space-y-2">
                    <div class="mb-6">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Enseignant</h3>
                    </div>
                    
                    <a href="{{ route('enseignant.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('enseignant.dashboard') 
                                 ? 'bg-green-100 text-green-700 shadow-sm border-l-4 border-green-500' 
                                 : 'text-gray-700 hover:bg-green-50 hover:text-green-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('enseignant.dashboard') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>

                    <a href="{{ route('enseignant.announcements') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('enseignant.announcements*') 
                                 ? 'bg-green-100 text-green-700 shadow-sm border-l-4 border-green-500' 
                                 : 'text-gray-700 hover:bg-green-50 hover:text-green-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('enseignant.announcements*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Mes Annonces
                    </a>

                    <a href="{{ route('enseignant.reservations') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('enseignant.reservations*') 
                                 ? 'bg-green-100 text-green-700 shadow-sm border-l-4 border-green-500' 
                                 : 'text-gray-700 hover:bg-green-50 hover:text-green-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('enseignant.reservations*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Mes Réservations
                    </a>

                    <a href="{{ route('enseignant.rooms') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('enseignant.rooms*') 
                                 ? 'bg-green-100 text-green-700 shadow-sm border-l-4 border-green-500' 
                                 : 'text-gray-700 hover:bg-green-50 hover:text-green-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('enseignant.rooms*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Salles & Matériels
                    </a>

                    <a href="{{ route('enseignant.profil') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('enseignant.profil*') 
                                 ? 'bg-green-100 text-green-700 shadow-sm border-l-4 border-green-500' 
                                 : 'text-gray-700 hover:bg-green-50 hover:text-green-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('enseignant.profil*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Mon Profil
                    </a>
                </div>

            @elseif(auth()->user()->role === 'admin')
                {{-- Menu Admin --}}
                <div class="space-y-2">
                    <div class="mb-6">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Admin</h3>
                    </div>
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.dashboard') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </a>

                    <a href="{{ route('admin.users.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.users*') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Utilisateurs
                    </a>

                    <a href="{{ route('admin.announcements') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.announcements*') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.announcements*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Annonces
                    </a>

                    <a href="{{ route('admin.reservations') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.reservations*') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.reservations*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Réservations
                    </a>

                    <a href="{{ route('admin.ressources.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.ressources*') || request()->routeIs('admin.rooms*') || request()->routeIs('admin.materials*') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.ressources*') || request()->routeIs('admin.rooms*') || request()->routeIs('admin.materials*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Ressources
                    </a>

                    <a href="{{ route('admin.stats.index') }}" 
                       class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 
                              {{ request()->routeIs('admin.stats*') 
                                 ? 'bg-purple-100 text-purple-700 shadow-sm border-l-4 border-purple-500' 
                                 : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600 hover:shadow-sm' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.stats*') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Statistiques
                    </a>
                </div>
            @endif
        </nav>

        {{-- Logout Button --}}
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit"
                    class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 hover:text-red-700 transition-all duration-200 group"
                >
                    <svg class="w-5 h-5 mr-3 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Mobile Sidebar Toggle Button --}}
<button 
    class="lg:hidden fixed bottom-4 right-4 z-50 w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-700 transition-all duration-200"
    onclick="document.getElementById('mobile-sidebar').classList.toggle('hidden')"
>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

{{-- Mobile Sidebar Overlay --}}
<div 
    id="mobile-sidebar" 
    class="lg:hidden fixed inset-0 z-40 hidden"
>
    {{-- Backdrop --}}
    <div 
        class="absolute inset-0 bg-black bg-opacity-50"
        onclick="document.getElementById('mobile-sidebar').classList.add('hidden')"
    ></div>
    
    {{-- Sidebar Content for Mobile --}}
    <div class="absolute left-0 top-0 bottom-0 w-64 bg-white shadow-2xl overflow-y-auto">
        <div class="h-full flex flex-col">
            {{-- Close Button --}}
            <div class="p-4 border-b border-gray-200">
                <button 
                    onclick="document.getElementById('mobile-sidebar').classList.add('hidden')"
                    class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation for Mobile --}}
            <nav class="flex-1 overflow-y-auto py-6 px-4">
                @if(auth()->user()->role === 'student')
                    <div class="space-y-2">
                        <div class="mb-6">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Étudiant</h3>
                        </div>
                        
                        <a href="{{ route('etudiant.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('etudiant.annonces') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            Annonces
                        </a>

                        <a href="{{ route('etudiant.salles') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Salles & Matériels
                        </a>

                        <a href="{{ route('etudiant.profil') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Mon Profil
                        </a>
                    </div>

                @elseif(auth()->user()->role === 'teacher')
                    <div class="space-y-2">
                        <div class="mb-6">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Enseignant</h3>
                        </div>
                        
                        <a href="{{ route('enseignant.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('enseignant.announcements') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            Mes Annonces
                        </a>

                        <a href="{{ route('enseignant.reservations') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Mes Réservations
                        </a>

                        <a href="{{ route('enseignant.rooms') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Salles & Matériels
                        </a>

                        <a href="{{ route('enseignant.profil') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Mon Profil
                        </a>
                    </div>

                @elseif(auth()->user()->role === 'admin')
                    <div class="space-y-2">
                        <div class="mb-6">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Menu Admin</h3>
                        </div>
                        
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Utilisateurs
                        </a>

                        <a href="{{ route('admin.announcements') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                            Annonces
                        </a>

                        <a href="{{ route('admin.reservations') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Réservations
                        </a>

                        <a href="{{ route('admin.ressources.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Ressources
                        </a>

                        <a href="{{ route('admin.stats.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200"
                           onclick="document.getElementById('mobile-sidebar').classList.add('hidden')">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Statistiques
                        </a>
                    </div>
                @endif
            </nav>

            {{-- Logout Button for Mobile --}}
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm font-medium text-red-600 rounded-xl hover:bg-red-50 hover:text-red-700 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce