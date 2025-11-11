@extends('layouts.app')

@section('title', 'Annonces - Étudiant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📢 Annonces du Campus</h1>
                    <p class="mt-2 text-gray-600">Restez informé des dernières actualités et événements</p>
                </div>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Annonces</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalAnnouncements ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $todayAnnouncements ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Cette Semaine</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $weekAnnouncements ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Mes Lectures</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalAnnouncements ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recherche seulement (pas de filtrage par catégorie) --}}
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
            <form method="GET" action="{{ route('etudiant.announcements') }}">
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                        <input 
                            type="text" 
                            name="search" 
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher dans le titre ou le contenu..." 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Liste des annonces --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Toutes les Annonces</h2>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($announcements ?? [] as $announcement)
                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        Annonce
                                    </span>
                                    <span class="text-gray-500 text-xs">{{ $announcement->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                                    {{ $announcement->title ?? 'Titre non disponible' }}
                                </h3>
                                
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ $announcement->content ?? 'Contenu non disponible' }}
                                </p>
                                
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Publié par {{ $announcement->user->firstname ?? 'Utilisateur' }} {{ $announcement->user->lastname ?? '' }}
                                    @if(isset($announcement->user->role))
                                        <span class="ml-2 px-2 py-1 text-xs rounded-full 
                                            {{ $announcement->user->role === 'teacher' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $announcement->user->role === 'teacher' ? 'Enseignant' : ucfirst($announcement->user->role) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="ml-6 flex-shrink-0">
                                <button class="text-blue-600 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune annonce trouvée</h3>
                        <p class="text-gray-500">Il n'y a pas d'annonces correspondant à vos critères de recherche.</p>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination --}}
            @if(isset($announcements) && method_exists($announcements, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection