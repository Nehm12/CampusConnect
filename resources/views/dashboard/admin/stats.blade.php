@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📊 Statistiques de la Plateforme</h1>
            <p class="mt-2 text-gray-600">Vue d'ensemble des données et activités</p>
        </div>

        {{-- ========== STATISTIQUES GLOBALES ========== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Utilisateurs --}}
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-semibold text-blue-700 mb-1">Total Utilisateurs</p>
                <p class="text-3xl font-bold text-blue-900">{{ $stats['total_users'] }}</p>
                <div class="mt-3 pt-3 border-t border-blue-200">
                    <div class="flex justify-between text-xs">
                        <span class="text-blue-600">👨‍🎓 Étudiants: {{ $stats['total_students'] }}</span>
                        <span class="text-blue-600">👨‍🏫 Enseignants: {{ $stats['total_teachers'] }}</span>
                    </div>
                </div>
            </div>

            {{-- Total Annonces --}}
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl shadow-lg p-6 border border-purple-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-semibold text-purple-700 mb-1">Total Annonces</p>
                <p class="text-3xl font-bold text-purple-900">{{ $stats['total_announcements'] }}</p>
                <p class="text-xs text-purple-600 mt-3">Publiées sur la plateforme</p>
            </div>

            {{-- Total Salles --}}
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-semibold text-green-700 mb-1">Salles Disponibles</p>
                <p class="text-3xl font-bold text-green-900">{{ $stats['total_rooms'] }}</p>
                <p class="text-xs text-green-600 mt-3">Prêtes à être réservées</p>
            </div>

            {{-- Total Matériels --}}
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl shadow-lg p-6 border border-orange-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-semibold text-orange-700 mb-1">Matériels Disponibles</p>
                <p class="text-3xl font-bold text-orange-900">{{ $stats['total_materials'] }}</p>
                <p class="text-xs text-orange-600 mt-3">En stock actuellement</p>
            </div>
        </div>

        {{-- ========== STATISTIQUES RÉSERVATIONS ========== --}}
        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Réservations
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                {{-- Total Réservations --}}
                <div class="text-center p-6 bg-indigo-50 rounded-xl border border-indigo-200">
                    <div class="w-16 h-16 bg-indigo-200 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-3xl">📋</span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-900">{{ $stats['total_reservations'] }}</p>
                    <p class="text-sm text-indigo-600 font-semibold mt-2">Total Réservations</p>
                </div>

                {{-- En attente --}}
                <div class="text-center p-6 bg-orange-50 rounded-xl border border-orange-200">
                    <div class="w-16 h-16 bg-orange-200 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-3xl">⏳</span>
                    </div>
                    <p class="text-3xl font-bold text-orange-900">{{ $stats['pending_reservations'] }}</p>
                    <p class="text-sm text-orange-600 font-semibold mt-2">En attente</p>
                </div>

                {{-- Approuvées --}}
                <div class="text-center p-6 bg-green-50 rounded-xl border border-green-200">
                    <div class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-3xl">✅</span>
                    </div>
                    <p class="text-3xl font-bold text-green-900">{{ $stats['approved_reservations'] }}</p>
                    <p class="text-sm text-green-600 font-semibold mt-2">Approuvées</p>
                </div>

                {{-- Rejetées --}}
                <div class="text-center p-6 bg-red-50 rounded-xl border border-red-200">
                    <div class="w-16 h-16 bg-red-200 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-3xl">❌</span>
                    </div>
                    <p class="text-3xl font-bold text-red-900">{{ $stats['rejected_reservations'] }}</p>
                    <p class="text-sm text-red-600 font-semibold mt-2">Rejetées</p>
                </div>
            </div>

            {{-- ✅ GRAPHIQUES CIRCULAIRES CORRIGÉS --}}
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-center text-lg font-semibold text-gray-700 mb-6">Répartition des réservations</h3>
                <div class="flex flex-wrap items-center justify-center gap-8">
                    @php
                        $total = $stats['total_reservations'] ?: 1;
                        $pendingPercent = round(($stats['pending_reservations'] / $total) * 100);
                        $approvedPercent = round(($stats['approved_reservations'] / $total) * 100);
                        $rejectedPercent = round(($stats['rejected_reservations'] / $total) * 100);
                        
                        // Calcul du stroke-dashoffset pour chaque cercle
                        $circumference = 2 * 3.14159 * 56;
                        $pendingOffset = $circumference * (1 - $pendingPercent / 100);
                        $approvedOffset = $circumference * (1 - $approvedPercent / 100);
                        $rejectedOffset = $circumference * (1 - $rejectedPercent / 100);
                    @endphp

                    {{-- En attente --}}
                    <div class="text-center">
                        <div class="relative w-32 h-32 mx-auto mb-3">
                            <svg class="transform -rotate-90 w-32 h-32" viewBox="0 0 128 128">
                                <circle cx="64" cy="64" r="56" stroke="#fed7aa" stroke-width="12" fill="none"/>
                                <circle 
                                    cx="64" 
                                    cy="64" 
                                    r="56" 
                                    stroke="#fb923c" 
                                    stroke-width="12" 
                                    fill="none"
                                    stroke-dasharray="{{ $circumference }}"
                                    stroke-dashoffset="{{ $pendingOffset }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-bold text-orange-600">{{ $pendingPercent }}%</span>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">⏳ En attente</p>
                        <p class="text-xs text-gray-500">{{ $stats['pending_reservations'] }} demandes</p>
                    </div>

                    {{-- Approuvées --}}
                    <div class="text-center">
                        <div class="relative w-32 h-32 mx-auto mb-3">
                            <svg class="transform -rotate-90 w-32 h-32" viewBox="0 0 128 128">
                                <circle cx="64" cy="64" r="56" stroke="#bbf7d0" stroke-width="12" fill="none"/>
                                <circle 
                                    cx="64" 
                                    cy="64" 
                                    r="56" 
                                    stroke="#22c55e" 
                                    stroke-width="12" 
                                    fill="none"
                                    stroke-dasharray="{{ $circumference }}"
                                    stroke-dashoffset="{{ $approvedOffset }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-bold text-green-600">{{ $approvedPercent }}%</span>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">✅ Approuvées</p>
                        <p class="text-xs text-gray-500">{{ $stats['approved_reservations'] }} validées</p>
                    </div>

                    {{-- Rejetées --}}
                    <div class="text-center">
                        <div class="relative w-32 h-32 mx-auto mb-3">
                            <svg class="transform -rotate-90 w-32 h-32" viewBox="0 0 128 128">
                                <circle cx="64" cy="64" r="56" stroke="#fecaca" stroke-width="12" fill="none"/>
                                <circle 
                                    cx="64" 
                                    cy="64" 
                                    r="56" 
                                    stroke="#ef4444" 
                                    stroke-width="12" 
                                    fill="none"
                                    stroke-dasharray="{{ $circumference }}"
                                    stroke-dashoffset="{{ $rejectedOffset }}"
                                    stroke-linecap="round"
                                />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-2xl font-bold text-red-600">{{ $rejectedPercent }}%</span>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-700">❌ Rejetées</p>
                        <p class="text-xs text-gray-500">{{ $stats['rejected_reservations'] }} refusées</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========== DEUX COLONNES ========== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Derniers utilisateurs inscrits --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Derniers Utilisateurs Inscrits
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($recentUsers as $user)
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</p>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                </div>
                                <div class="text-right">
                                    @if($user->role == 'admin')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                    @elseif($user->role == 'enseignant')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Enseignant</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Étudiant</span>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">Aucun utilisateur récent</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Dernières réservations --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Dernières Réservations
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @forelse($recentReservations as $reservation)
                            <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($reservation->user->firstname, 0, 1)) }}{{ strtoupper(substr($reservation->user->lastname, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900 text-sm">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</p>
                                            <p class="text-xs text-gray-600">
                                                @if($reservation->room)
                                                    🏛️ {{ $reservation->room->name }}
                                                @endif
                                                @if($reservation->materials && $reservation->materials->isNotEmpty())
                                                    @if($reservation->room)
                                                        <span class="mx-1">+</span>
                                                    @endif
                                                    🔧 {{ $reservation->materials->count() }} matériel(s)
                                                @endif
                                                @if(!$reservation->room && (!$reservation->materials || $reservation->materials->isEmpty()))
                                                    ⚠️ Aucune ressource
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    @if($reservation->status == 'pending')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">⏳</span>
                                    @elseif($reservation->status == 'approved')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✅</span>
                                    @elseif($reservation->status == 'rejected')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">❌</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">🚫</span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">{{ $reservation->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-8">Aucune réservation récente</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection