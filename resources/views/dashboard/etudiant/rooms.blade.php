@extends('layouts.app')

@section('title', 'Salles & Matériels - Étudiant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">🏫 Salles & Matériels</h1>
                    <p class="mt-2 text-gray-600">Consultez la disponibilité des salles et matériels du campus</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input 
                            type="text" 
                            placeholder="Rechercher..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistiques rapides --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-6 border border-blue-200 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-200 rounded-lg shadow-inner">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <p class="text-sm font-semibold text-blue-700 uppercase tracking-wide">Salles du Campus</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $availableRooms ?? 0 }}</p>
                        <p class="text-blue-600 text-sm">Salles disponibles</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-6 border border-green-200 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center">
                    <div class="p-3 bg-green-200 rounded-lg shadow-inner">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <p class="text-sm font-semibold text-green-700 uppercase tracking-wide">Matériels Campus</p>
                        <p class="text-3xl font-bold text-green-900">{{ $availableMaterials ?? 0 }}</p>
                        <p class="text-green-600 text-sm">Types de matériel</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Onglets --}}
        <div class="mb-8">
            <div class="border-b border-gray-200 bg-white rounded-t-xl shadow-sm">
                <nav class="-mb-px flex space-x-8 px-6">
                    <button 
                        onclick="showTab('salles')" 
                        id="tab-salles"
                        class="tab-button border-b-2 border-blue-500 text-blue-600 py-4 px-2 text-lg font-semibold"
                    >
                        🏫 Salles de Cours
                    </button>
                    <button 
                        onclick="showTab('materiels')" 
                        id="tab-materiels"
                        class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-2 text-lg font-semibold"
                    >
                        💻 Matériels Informatiques
                    </button>
                </nav>
            </div>
        </div>

        {{-- Contenu Salles --}}
        <div id="content-salles" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                    <h2 class="text-xl font-bold text-blue-900 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Salles de Cours du Campus
                    </h2>
                    <p class="text-blue-700 text-sm mt-1">Découvrez toutes les salles disponibles avec leurs équipements</p>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($rooms ?? [] as $room)
                            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $room->name }}</h3>
                                        <p class="text-sm font-medium text-blue-600 bg-blue-100 inline-block px-2 py-1 rounded">{{ $room->code }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        ✅ Consultable
                                    </span>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="font-semibold">Capacité:</span> {{ $room->capacity }} personnes
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="font-semibold">Localisation:</span> {{ $room->location }}
                                    </div>
                                </div>
                                
                                @if($room->notes)
                                    <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-sm font-semibold text-blue-800 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Informations:
                                        </p>
                                        <p class="text-sm text-blue-700 leading-relaxed">{{ Str::limit($room->notes, 120) }}</p>
                                    </div>
                                @endif
                                
                                <button onclick="alert('Informations de la salle {{ $room->name }} consultées !')" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 px-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 text-sm font-bold shadow-md hover:shadow-lg">
                                    📋 Consulter les Détails
                                </button>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune salle disponible</h3>
                                <p class="text-gray-500">Il n'y a pas de salles disponibles pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Contenu Matériels --}}
        <div id="content-materiels" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-green-100 rounded-t-xl">
                    <h2 class="text-xl font-bold text-green-900 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Matériels Informatiques du Campus
                    </h2>
                    <p class="text-green-700 text-sm mt-1">Explorez tous les équipements et matériels disponibles</p>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($materials ?? [] as $material)
                            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:border-green-300 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $material->name }}</h3>
                                        <p class="text-sm font-medium text-green-600 bg-green-100 inline-block px-2 py-1 rounded">{{ $material->code }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                        {{ $material->quantity_total > 0 ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                        {{ $material->quantity_total > 0 ? '✅ Disponible' : '❌ Épuisé' }}
                                    </span>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        <span class="font-semibold">Quantité:</span> {{ $material->quantity_total }} unité(s)
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="font-semibold">Localisation:</span> {{ $material->location }}
                                    </div>
                                </div>
                                
                                @if($material->notes)
                                    <div class="mb-6 bg-green-50 p-4 rounded-lg border border-green-200">
                                        <p class="text-sm font-semibold text-green-800 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Spécifications:
                                        </p>
                                        <p class="text-sm text-green-700 leading-relaxed">{{ Str::limit($material->notes, 120) }}</p>
                                    </div>
                                @endif
                                
                                @if($material->quantity_total > 0)
                                    <button onclick="alert('Informations du matériel {{ $material->name }} consultées !')" class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 px-4 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 text-sm font-bold shadow-md hover:shadow-lg">
                                        📋 Consulter les Détails
                                    </button>
                                @else
                                    <button disabled class="w-full bg-gray-300 text-gray-500 py-3 px-4 rounded-lg cursor-not-allowed text-sm font-bold">
                                        ❌ Non Disponible
                                    </button>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full text-center py-16">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun matériel disponible</h3>
                                <p class="text-gray-500">Il n'y a pas de matériel disponible pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showTab(tabName) {
    // Cacher tous les contenus
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Réinitialiser tous les boutons d'onglets
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Afficher le contenu sélectionné
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Activer le bouton d'onglet sélectionné
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-500', 'text-blue-600');
}
</script>
@endpush
@endsection