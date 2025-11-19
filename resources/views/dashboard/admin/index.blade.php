@extends('layouts.app')

@section('title', 'Tableau de bord - Administrateur')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">🎛️ Tableau de bord Administrateur</h1>
            <p class="mt-2 text-gray-600">Gérez l'ensemble de la plateforme CampusConnect</p>
        </div>

        {{-- Statistiques principales --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {{-- Utilisateurs --}}
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-blue-900">{{ $stats['total_users'] }}</span>
                </div>
                <p class="text-blue-700 font-semibold">Total Utilisateurs</p>
                <div class="mt-2 text-xs text-blue-600">
                    <span>👨‍🎓 {{ $stats['total_students'] }} étudiants</span><br>
                    <span>👨‍🏫 {{ $stats['total_teachers'] }} enseignants</span><br>
                    <span>👔 {{ $stats['total_admins'] }} admins</span>
                </div>
                <a href="{{ route('admin.users.index') }}" class="mt-4 inline-flex items-center text-blue-700 text-sm font-semibold hover:text-blue-800">
                    Gérer →
                </a>
            </div>

            {{-- Annonces --}}
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-green-900">{{ $stats['total_announcements'] }}</span>
                </div>
                <p class="text-green-700 font-semibold">Annonces Publiées</p>
                <a href="{{ route('admin.announcements') }}" class="mt-4 inline-flex items-center text-green-700 text-sm font-semibold hover:text-green-800">
                    Gérer →
                </a>
            </div>

            {{-- Réservations --}}
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-purple-900">{{ $stats['pending_reservations'] }}</span>
                </div>
                <p class="text-purple-700 font-semibold">En Attente</p>
                <div class="mt-2 text-xs text-purple-600">
                    <span>✅ {{ $stats['approved_reservations'] }} approuvées</span><br>
                    <span>❌ {{ $stats['rejected_reservations'] }} rejetées</span>
                </div>
                <a href="{{ route('admin.reservations') }}" class="mt-4 inline-flex items-center text-purple-700 text-sm font-semibold hover:text-purple-800">
                    Gérer →
                </a>
            </div>

            {{-- Ressources --}}
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-lg p-6 border border-orange-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-orange-900">{{ $stats['total_rooms'] + $stats['total_materials'] }}</span>
                </div>
                <p class="text-orange-700 font-semibold">Ressources</p>
                <div class="mt-2 text-xs text-orange-600">
                    <span>🏢 {{ $stats['total_rooms'] }} salles</span><br>
                    <span>💻 {{ $stats['total_materials'] }} matériels</span>
                </div>
                <a href="{{ route('admin.ressources.index') }}" class="mt-4 inline-flex items-center text-orange-700 text-sm font-semibold hover:text-orange-800">
                    Gérer →
                </a>
            </div>
        </div>

        {{-- Actions rapides --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <button onclick="window.location.href='{{ route('admin.users.index') }}'" class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Ajouter un utilisateur</p>
                        <p class="text-sm text-gray-600">Créer un nouveau compte</p>
                    </div>
                </div>
            </button>

            <button onclick="window.location.href='{{ route('admin.announcements') }}'" class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Publier une annonce</p>
                        <p class="text-sm text-gray-600">Nouvelle communication</p>
                    </div>
                </div>
            </button>

            <a href="{{ route('admin.reservations') }}?status=en_attente" class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Valider réservations</p>
                        <p class="text-sm text-gray-600">{{ $stats['pending_reservations'] }} en attente</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Sections supplémentaires --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Dernières annonces --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-4">📢 Dernières Annonces</h3>
                <div class="space-y-3">
                    @forelse($recentAnnouncements as $announcement)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <p class="font-semibold text-gray-900">{{ Str::limit($announcement->title, 50) }}</p>
                            <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucune annonce récente</p>
                    @endforelse
                </div>
                <a href="{{ route('admin.announcements') }}" class="mt-4 inline-block text-blue-600 text-sm font-semibold hover:text-blue-700">
                    Voir toutes les annonces →
                </a>
            </div>

            {{-- Réservations en attente --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-4">⏳ Réservations en Attente</h3>
                <div class="space-y-3">
                    @forelse($pendingReservations as $reservation)
                        <div class="border-l-4 border-orange-500 pl-4 py-2">
                            <p class="font-semibold text-gray-900">
                                {{ $reservation->user->firstname }} {{ $reservation->user->lastname }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $reservation->room ? 'Salle: ' . $reservation->room->name : 'Matériel: ' . $reservation->material->name }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $reservation->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Aucune réservation en attente</p>
                    @endforelse
                </div>
                <a href="{{ route('admin.reservations') }}" class="mt-4 inline-block text-purple-600 text-sm font-semibold hover:text-purple-700">
                    Voir toutes les réservations →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection