@extends('layouts.app')

@section('title', 'Tableau de bord - Étudiant')

@section('page-header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Bonjour, {{ auth()->user()->firstname ?? auth()->user()->name ?? 'Étudiant' }} ! 👋
            </h1>
            <p class="text-gray-600 mt-1">Bienvenue sur votre tableau de bord</p>
        </div>
        <div class="text-sm text-gray-500">
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
        </div>
    </div>
@endsection

@section('content')
    {{-- Statistiques Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card 1 : Annonces récentes --}}
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-700 text-sm font-semibold uppercase tracking-wide">Annonces récentes</p>
                    <p class="text-4xl font-bold text-blue-900 mt-2">{{ $stats['recent_announcements'] ?? 0 }}</p>
                    <p class="text-blue-600 text-xs mt-1">Cette semaine</p>
                </div>
                <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('etudiant.announcements') }}" class="inline-flex items-center text-blue-700 text-sm font-semibold mt-4 hover:text-blue-800 transition-colors duration-200">
                Voir toutes les annonces
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Card 2 : Salles disponibles --}}
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-700 text-sm font-semibold uppercase tracking-wide">Salles campus</p>
                    <p class="text-4xl font-bold text-green-900 mt-2">{{ $stats['available_rooms'] ?? 0 }}</p>
                    <p class="text-green-600 text-xs mt-1">Salles au total</p>
                </div>
                <div class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('etudiant.rooms') }}" class="inline-flex items-center text-green-700 text-sm font-semibold mt-4 hover:text-green-800 transition-colors duration-200">
                Explorer les salles
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Card 3 : Matériels disponibles --}}
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-700 text-sm font-semibold uppercase tracking-wide">Matériels campus</p>
                    <p class="text-4xl font-bold text-purple-900 mt-2">{{ $stats['available_materials'] ?? 0 }}</p>
                    <p class="text-purple-600 text-xs mt-1">Types de matériel</p>
                </div>
                <div class="w-16 h-16 bg-purple-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('etudiant.rooms') }}" class="inline-flex items-center text-purple-700 text-sm font-semibold mt-4 hover:text-purple-800 transition-colors duration-200">
                Consulter le matériel
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Dernières Annonces --}}
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Dernières annonces</h2>
            </div>
            <a href="{{ route('etudiant.announcements') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                Voir toutes les annonces
            </a>
        </div>

        <div class="space-y-4">
            @forelse($announcements as $announcement)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-md transition-all duration-200 hover:bg-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                    📢 Annonce
                                </span>
                                <span class="text-gray-500 text-sm">{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                {{ $announcement->title ?? 'Titre non disponible' }}
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($announcement->content ?? 'Contenu non disponible', 150) }}
                            </p>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="font-medium">
                                    {{ $announcement->user->firstname ?? 'Utilisateur' }} {{ $announcement->user->lastname ?? '' }}
                                </span>
                            </div>
                        </div>
                        <button class="ml-6 p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune annonce récente</h3>
                    <p class="text-gray-500">Les nouvelles annonces apparaîtront ici</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Actions Rapides --}}
    <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
        <div class="flex items-center mb-8">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Actions rapides</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Action 1: Annonces --}}
            <a href="{{ route('etudiant.announcements') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center group-hover:bg-blue-300 transition-colors duration-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        {{ $stats['recent_announcements'] ?? 0 }}
                    </span>
                </div>
                <h3 class="text-lg font-bold text-blue-900 mb-2">Consulter les annonces</h3>
                <p class="text-blue-700 text-sm">Restez informé des dernières actualités du campus</p>
            </a>

            {{-- Action 2: Salles --}}
            <a href="{{ route('etudiant.rooms') }}" class="group bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center group-hover:bg-green-300 transition-colors duration-200">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        {{ $stats['available_rooms'] ?? 0 }}
                    </span>
                </div>
                <h3 class="text-lg font-bold text-green-900 mb-2">Explorer les salles</h3>
                <p class="text-green-700 text-sm">Découvrez les salles et équipements disponibles</p>
            </a>

            {{-- Action 3: Profil --}}
            <a href="{{ route('etudiant.profil') }}" class="group bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center group-hover:bg-orange-300 transition-colors duration-200">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="bg-orange-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        •
                    </span>
                </div>
                <h3 class="text-lg font-bold text-orange-900 mb-2">Gérer mon profil</h3>
                <p class="text-orange-700 text-sm">Mettez à jour vos informations personnelles</p>
            </a>
        </div>
    </div>
@endsection