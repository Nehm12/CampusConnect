@extends('layouts.app')

@section('title', 'Mon Profil - Étudiant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">👤 Mon Profil</h1>
            <p class="mt-2 text-gray-600">Gérez vos informations personnelles et préférences</p>
        </div>

        {{-- Informations Profil --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informations Personnelles</h2>
            </div>
            
            <div class="p-6">
                <div class="flex items-center space-x-6 mb-6">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr(auth()->user()->firstname ?? 'U', 0, 1) }}{{ substr(auth()->user()->lastname ?? 'U', 0, 1) }}
                        </div>
                    </div>
                    
                    {{-- Infos Utilisateur --}}
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ auth()->user()->firstname ?? 'Prénom' }} {{ auth()->user()->lastname ?? 'Nom' }}
                        </h3>
                        <p class="text-gray-600">{{ auth()->user()->email ?? 'email@example.com' }}</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mt-2">
                            🎓 {{ ucfirst(auth()->user()->role ?? 'Étudiant') }}
                        </span>
                    </div>
                    
                    {{-- Bouton Modifier --}}
                    <div class="flex-shrink-0">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Modifier le Profil
                        </button>
                    </div>
                </div>

                {{-- Détails Profil --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ auth()->user()->firstname ?? 'Non renseigné' }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ auth()->user()->lastname ?? 'Non renseigné' }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ auth()->user()->email ?? 'Non renseigné' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ ucfirst(auth()->user()->role ?? 'Étudiant') }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Membre depuis</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                {{ auth()->user()->created_at ? auth()->user()->created_at->format('d/m/Y') : 'Non disponible' }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email vérifié</label>
                            <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900">
                                @if(auth()->user()->email_verified_at)
                                    <span class="text-green-600 font-medium">✓ Vérifié</span>
                                @else
                                    <span class="text-red-600 font-medium">✗ Non vérifié</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistiques Activité --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Mes Statistiques</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">0</div>
                        <div class="text-sm text-gray-600">Réservations Total</div>
                    </div>
                    
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">0</div>
                        <div class="text-sm text-gray-600">Réservations Approuvées</div>
                    </div>
                    
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900">0</div>
                        <div class="text-sm text-gray-600">En Attente</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions Rapides --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Actions Rapides</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Modifier mes informations</h3>
                            <p class="text-sm text-gray-500">Mettre à jour mon profil</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-green-500 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Changer mon mot de passe</h3>
                            <p class="text-sm text-gray-500">Sécuriser mon compte</p>
                        </div>
                    </a>

                    <a href="{{ route('etudiant.announcements') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-purple-500 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Voir les annonces</h3>
                            <p class="text-sm text-gray-500">Consulter les actualités</p>
                        </div>
                    </a>

                    <a href="{{ route('etudiant.rooms') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-orange-500 hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Consulter les ressources</h3>
                            <p class="text-sm text-gray-500">Salles et matériels</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection