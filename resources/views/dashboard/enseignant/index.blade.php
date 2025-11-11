@extends('layouts.app')

@section('title', 'Tableau de bord - Enseignant')

@section('page-header')
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Bonjour, {{ auth()->user()->firstname ?? auth()->user()->name ?? 'Enseignant' }} ! 👋
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- Card 1 : Mes Annonces --}}
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-700 text-sm font-semibold uppercase tracking-wide">Mes Annonces</p>
                    <p class="text-4xl font-bold text-blue-900 mt-2">{{ $stats['my_announcements'] ?? 0 }}</p>
                    <p class="text-blue-600 text-xs mt-1">Publiées</p>
                </div>
                <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('enseignant.announcements') }}" class="inline-flex items-center text-blue-700 text-sm font-semibold mt-4 hover:text-blue-800 transition-colors duration-200">
                Gérer mes annonces
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Card 2 : Mes Réservations --}}
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-700 text-sm font-semibold uppercase tracking-wide">Mes Réservations</p>
                    <p class="text-4xl font-bold text-purple-900 mt-2">{{ $stats['my_reservations'] ?? 0 }}</p>
                    <p class="text-purple-600 text-xs mt-1">Active(s)</p>
                </div>
                <div class="w-16 h-16 bg-purple-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('enseignant.reservations') }}" class="inline-flex items-center text-purple-700 text-sm font-semibold mt-4 hover:text-purple-800 transition-colors duration-200">
                Voir mes réservations
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Card 3 : Salles disponibles --}}
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-700 text-sm font-semibold uppercase tracking-wide">Salles campus</p>
                    <p class="text-4xl font-bold text-green-900 mt-2">{{ $stats['available_rooms'] ?? 0 }}</p>
                    <p class="text-green-600 text-xs mt-1">Disponibles</p>
                </div>
                <div class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('enseignant.rooms') }}" class="inline-flex items-center text-green-700 text-sm font-semibold mt-4 hover:text-green-800 transition-colors duration-200">
                Explorer les salles
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Card 4 : Matériels disponibles --}}
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-lg p-6 border border-orange-200 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-700 text-sm font-semibold uppercase tracking-wide">Matériels</p>
                    <p class="text-4xl font-bold text-orange-900 mt-2">{{ $stats['available_materials'] ?? 0 }}</p>
                    <p class="text-orange-600 text-xs mt-1">Unités total</p>
                </div>
                <div class="w-16 h-16 bg-orange-200 rounded-full flex items-center justify-center shadow-inner">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <a href="{{ route('enseignant.rooms') }}" class="inline-flex items-center text-orange-700 text-sm font-semibold mt-4 hover:text-orange-800 transition-colors duration-200">
                Consulter le matériel
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
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
            {{-- Action 1: Créer Annonce --}}
            <a href="{{ route('enseignant.announcements') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center group-hover:bg-blue-300 transition-colors duration-200">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        Nouveau
                    </span>
                </div>
                <h3 class="text-lg font-bold text-blue-900 mb-2">Créer une annonce</h3>
                <p class="text-blue-700 text-sm">Publier une nouvelle annonce pour les étudiants</p>
            </a>

            {{-- Action 2: Réserver --}}
            <a href="{{ route('enseignant.rooms') }}" class="group bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center group-hover:bg-green-300 transition-colors duration-200">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                        {{ $stats['available_rooms'] ?? 0 }}
                    </span>
                </div>
                <h3 class="text-lg font-bold text-green-900 mb-2">Faire une réservation</h3>
                <p class="text-green-700 text-sm">Réserver une salle ou emprunter du matériel</p>
            </a>

            {{-- Action 3: Profil --}}
            <a href="{{ route('enseignant.profil') }}" class="group bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
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
                <p class="text-orange-700 text-sm">Mettre à jour mes informations personnelles</p>
            </a>
        </div>
    </div>

    {{-- Mes Dernières Annonces --}}
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border border-gray-100 mt-8">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Mes dernières annonces</h2>
            </div>
            <a href="{{ route('enseignant.announcements') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                Gérer toutes mes annonces
            </a>
        </div>

        <div class="space-y-4">
            @forelse($myAnnouncements ?? [] as $announcement)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-md transition-all duration-200 hover:bg-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                    📢 Ma Publication
                                </span>
                                <span class="text-gray-500 text-sm">{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">
                                {{ $announcement->title ?? 'Titre non disponible' }}
                            </h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($announcement->content ?? 'Contenu non disponible', 150) }}
                            </p>
                        </div>
                        <button class="ml-6 p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
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
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune annonce publiée</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore publié d'annonces</p>
                    <a href="{{ route('enseignant.announcements') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                        Créer une annonce
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Mes Dernières Réservations --}}
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Mes dernières réservations</h2>
            </div>
            <a href="{{ route('enseignant.reservations') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors duration-200">
                Voir toutes mes réservations
            </a>
        </div>

        <div class="space-y-4">
            @forelse($myReservations ?? [] as $reservation)
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-md transition-all duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $reservation->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                       ($reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $reservation->status === 'approved' ? '✅ Approuvée' : 
                                       ($reservation->status === 'pending' ? '⏳ En attente' : '❌ Refusée') }}
                                </span>
                                <span class="text-gray-500 text-sm">{{ $reservation->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $reservation->room->name ?? 'Matériel emprunté' }}
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <strong>Date:</strong> {{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') : 'N/A' }} |
                                <strong>Horaire:</strong> {{ $reservation->start_time ?? 'N/A' }} - {{ $reservation->end_time ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore fait de réservations</p>
                    <a href="{{ route('enseignant.rooms') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors duration-200">
                        Faire ma première réservation
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection