@extends('layouts.app')

@section('title', 'Détail de l\'annonce')

@section('page-header')
    <div class="flex items-center justify-between">
        <div>
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('etudiant.dashboard') }}" class="hover:text-blue-600">Tableau de bord</a>
                <span>→</span>
                <a href="{{ route('etudiant.announcements') }}" class="hover:text-blue-600">Annonces</a>
                <span>→</span>
                <span class="text-gray-900">Détail</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-800">📢 Détail de l'annonce</h1>
        </div>
        <a href="{{ route('etudiant.announcements') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour aux annonces
        </a>
    </div>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-8">
            {{-- Header de l'annonce --}}
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="flex items-center space-x-3 mb-4">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-700">
                        Général
                    </span>
                    <span class="text-gray-500 text-sm">Publié le {{ now()->format('d/m/Y à H:i') }}</span>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    Titre de l'annonce (ID: {{ $id }})
                </h1>
                
                <div class="flex items-center text-sm text-gray-600">
                    <div class="flex items-center mr-6">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Nom de l'auteur</p>
                            <p class="text-xs text-gray-500">Enseignant</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Dernière modification : {{ now()->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>

            {{-- Contenu de l'annonce --}}
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed text-lg">
                    Ceci est le contenu détaillé de l'annonce avec l'ID {{ $id }}. 
                    Dans une vraie application, ce contenu serait récupéré depuis la base de données.
                </p>
                
                <p class="text-gray-700 leading-relaxed text-lg mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                
                <p class="text-gray-700 leading-relaxed text-lg mt-4">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

            {{-- Actions --}}
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            J'aime
                        </button>
                        
                        <button class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                            </svg>
                            Partager
                        </button>
                    </div>
                    
                    <div class="text-sm text-gray-500">
                        Vu {{ rand(50, 200) }} fois
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Annonces similaires --}}
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Autres annonces récentes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @for($i = 1; $i <= 4; $i++)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Événement
                        </span>
                        <span class="text-gray-500 text-xs">Il y a {{ $i }} jour(s)</span>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Annonce similaire {{ $i }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-3">
                        Aperçu du contenu de cette annonce similaire...
                    </p>
                    <a href="{{ route('etudiant.announcements.show', $i) }}" class="text-blue-600 text-sm hover:text-blue-700">
                        Lire plus →
                    </a>
                </div>
            @endfor
        </div>
    </div>
@endsection