@extends('layouts.app')

@section('title', 'Mes Réservations - Enseignant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Messages --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📅 Mes Réservations</h1>
                    <p class="mt-2 text-gray-600">Gérez vos réservations de salles et matériels</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button 
                        onclick="window.location.href='{{ route('enseignant.rooms') }}'"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Nouvelle Réservation
                    </button>
                </div>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 cursor-pointer hover:shadow-xl transition-shadow" 
                 onclick="filterByStatus('approved')">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Approuvées</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['confirmed'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 cursor-pointer hover:shadow-xl transition-shadow" 
                 onclick="filterByStatus('pending')">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">En Attente</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['pending'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 cursor-pointer hover:shadow-xl transition-shadow" 
                 onclick="filterByStatus('rejected')">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rejetées</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['rejected'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 cursor-pointer hover:shadow-xl transition-shadow" 
                 onclick="filterByStatus('cancelled')">
                <div class="flex items-center">
                    <div class="p-3 bg-gray-100 rounded-lg">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Annulées</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['cancelled'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filtres et Recherche --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <label for="search" class="sr-only">Rechercher</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" id="search" 
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm"
                               placeholder="Rechercher par salle, matériel, référence..."
                               onkeyup="searchReservations()">
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <select id="statusFilter" 
                            class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            onchange="filterReservations()">
                        <option value="all">Tous les statuts</option>
                        <option value="approved">✅ Approuvé</option>
                        <option value="pending">⏳ En attente</option>
                        <option value="rejected">❌ Rejeté</option>
                        <option value="cancelled">🚫 Annulé</option>
                    </select>
                    
                    <select id="typeFilter" 
                            class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            onchange="filterReservations()">
                        <option value="all">Tous les types</option>
                        <option value="room">🏢 Salles</option>
                        <option value="material">📦 Matériels</option>
                    </select>
                    
                    <button onclick="resetFilters()" 
                            class="px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        🔄 Réinitialiser
                    </button>
                </div>
            </div>
        </div>

        {{-- Liste des réservations --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                <h2 class="text-xl font-bold text-blue-900">
                    Toutes mes réservations 
                    (<span id="visibleCount">{{ count($reservations ?? []) }}</span> / {{ $stats['total'] ?? 0 }})
                </h2>
            </div>
            
            <div class="p-6" id="reservationsList">
                @forelse($reservations ?? [] as $reservation)
                    <div class="reservation-item bg-gray-50 border border-gray-200 rounded-xl p-6 mb-4 hover:shadow-md transition-all duration-200"
                         data-status="{{ $reservation->status }}"
                         data-type="{{ $reservation->room ? 'room' : 'material' }}"
                         data-search="{{ strtolower($reservation->room ? $reservation->room->name : 'matériel') }} {{ strtolower($reservation->reference) }} {{ strtolower($reservation->purpose) }}"
                         data-reservation='@json($reservation)'>
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">
                                        @if($reservation->room)
                                            🏢 {{ $reservation->room->name }}
                                        @else
                                            📦 Matériel
                                        @endif
                                    </h3>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        {{ $reservation->status == 'approved' ? 'bg-green-100 text-green-700' : 
                                           ($reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                           ($reservation->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                                        {{ $reservation->status == 'approved' ? '✅ Approuvé' : 
                                           ($reservation->status == 'pending' ? '⏳ En attente' : 
                                           ($reservation->status == 'rejected' ? '❌ Rejeté' : '🚫 Annulé')) }}
                                    </span>
                                    @if($reservation->reference)
                                        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">
                                            📋 {{ $reservation->reference }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <strong>Début:</strong>&nbsp;{{ \Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y à H:i') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <strong>Fin:</strong>&nbsp;{{ \Carbon\Carbon::parse($reservation->end_time)->format('d/m/Y à H:i') }}
                                    </div>
                                </div>
                                
                                @if($reservation->purpose)
                                    <p class="text-gray-600 mb-3">
                                        💡 <strong>Motif:</strong> {{ $reservation->purpose }}
                                    </p>
                                @endif
                                
                                @if($reservation->materials && $reservation->materials->count() > 0)
                                    <div class="mt-3 bg-blue-50 p-3 rounded-lg">
                                        <p class="text-sm font-semibold text-blue-900 mb-2">📦 Matériels réservés:</p>
                                        <ul class="text-sm text-blue-800 space-y-1">
                                            @foreach($reservation->materials as $material)
                                                <li>• {{ $material->name }} (Quantité: {{ $material->pivot->quantity }})</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if($reservation->admin && $reservation->status == 'rejected' && $reservation->rejection_reason)
                                    <div class="mt-3 bg-red-50 p-3 rounded-lg border border-red-200">
                                        <p class="text-sm font-semibold text-red-900 mb-1">❌ Motif du rejet:</p>
                                        <p class="text-sm text-red-800">{{ $reservation->rejection_reason }}</p>
                                        <p class="text-xs text-red-600 mt-1">Par: {{ $reservation->admin->firstname }} {{ $reservation->admin->lastname }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex flex-col space-y-2 ml-4">
                                @if(in_array($reservation->status, ['pending', 'approved']))
                                    <button 
                                        onclick="openEditModal({{ $reservation->id }})"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 text-center">
                                        ✏️ Modifier
                                    </button>
                                    <form action="{{ route('enseignant.reservations.cancel', $reservation->id) }}" method="POST" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="w-full bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors duration-200">
                                            ❌ Annuler
                                        </button>
                                    </form>
                                @endif
                                <button 
                                    onclick="openDetailsModal({{ $reservation->id }})"
                                    class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors duration-200 text-center">
                                    👁️ Détails
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune réservation</h3>
                        <p class="text-gray-500 mb-6">Vous n'avez encore aucune réservation</p>
                        <button 
                            onclick="window.location.href='{{ route('enseignant.rooms') }}'"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            📅 Faire une réservation
                        </button>
                    </div>
                @endforelse

                <div id="noResults" class="hidden text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun résultat</h3>
                    <p class="text-gray-500 mb-6">Aucune réservation ne correspond à vos critères de recherche</p>
                    <button onclick="resetFilters()" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        🔄 Réinitialiser les filtres
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Détails --}}
<div id="detailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-xl bg-white mb-10">
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h3 class="text-2xl font-bold text-gray-900">📋 Détails de la Réservation</h3>
            <button onclick="closeDetailsModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold leading-none">×</button>
        </div>
        <div id="detailsContent" class="space-y-6"></div>
    </div>
</div>

{{-- Modal Modification --}}
<div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-xl bg-white mb-10">
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h3 class="text-2xl font-bold text-gray-900">✏️ Modifier la Réservation</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold leading-none">×</button>
        </div>
        
        <form id="editForm" method="POST" action="" class="space-y-6">
            @csrf
            @method('PUT')
            <div id="editContent"></div>
            <div class="flex justify-end space-x-4 pt-6 border-t">
                <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Fonctions de filtrage
function filterReservations() {
    const statusFilter = document.getElementById('statusFilter').value;
    const typeFilter = document.getElementById('typeFilter').value;
    const searchValue = document.getElementById('search').value.toLowerCase();
    const items = document.querySelectorAll('.reservation-item');
    let visibleCount = 0;
    
    items.forEach(item => {
        const status = item.dataset.status;
        const type = item.dataset.type;
        const searchText = item.dataset.search;
        let showItem = true;
        
        if (statusFilter !== 'all' && status !== statusFilter) showItem = false;
        if (typeFilter !== 'all' && type !== typeFilter) showItem = false;
        if (searchValue && !searchText.includes(searchValue)) showItem = false;
        
        item.style.display = showItem ? 'block' : 'none';
        if (showItem) visibleCount++;
    });
    
    document.getElementById('visibleCount').textContent = visibleCount;
    const noResults = document.getElementById('noResults');
    noResults.classList.toggle('hidden', visibleCount > 0 || items.length === 0);
}

function searchReservations() { filterReservations(); }
function filterByStatus(status) { document.getElementById('statusFilter').value = status; filterReservations(); }
function resetFilters() {
    document.getElementById('statusFilter').value = 'all';
    document.getElementById('typeFilter').value = 'all';
    document.getElementById('search').value = '';
    filterReservations();
}

// Utilitaires
function formatDateTime(dateTime) {
    return new Date(dateTime).toLocaleDateString('fr-FR', { 
        year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit'
    }).replace(',', ' à');
}

function getStatusClass(status) {
    const classes = { approved: 'bg-green-100 text-green-700', pending: 'bg-yellow-100 text-yellow-700', 
                     rejected: 'bg-red-100 text-red-700', cancelled: 'bg-gray-100 text-gray-700' };
    return classes[status] || 'bg-gray-100 text-gray-700';
}

function getStatusText(status) {
    const texts = { approved: '✅ Approuvé', pending: '⏳ En attente', rejected: '❌ Rejeté', cancelled: '🚫 Annulé' };
    return texts[status] || status;
}

function calculateDuration(startTime, endTime) {
    return Math.round((new Date(`2000-01-01 ${endTime}`) - new Date(`2000-01-01 ${startTime}`)) / 3600000);
}

// Modal Détails
function openDetailsModal(reservationId) {
    const modal = document.getElementById('detailsModal');
    const content = document.getElementById('detailsContent');
    let data = null;
    
    document.querySelectorAll('.reservation-item').forEach(item => {
        try {
            const reservationData = JSON.parse(item.dataset.reservation);
            if (reservationData.id === reservationId) data = reservationData;
        } catch (e) { console.error('Erreur parsing:', e); }
    });
    
    if (!data) { alert('⚠️ Erreur lors du chargement des détails'); return; }
    
    content.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-blue-900 mb-2">Type de ressource</p>
                <p class="text-lg font-bold text-blue-700">${data.room ? '🏢 Salle' : '📦 Matériel'}</p>
            </div>
            <div class="bg-green-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-green-900 mb-2">Nom de la ressource</p>
                <p class="text-lg font-bold text-green-700">
                    ${data.room ? data.room.name : 'Matériel'}
                    ${data.room && data.room.code ? `<span class="text-sm">(${data.room.code})</span>` : ''}
                </p>
            </div>
            <div class="bg-purple-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-purple-900 mb-2">📅 Début</p>
                <p class="text-lg font-bold text-purple-700">${formatDateTime(data.start_time)}</p>
            </div>
            <div class="bg-orange-50 p-4 rounded-lg">
                <p class="text-sm font-medium text-orange-900 mb-2">⏰ Fin</p>
                <p class="text-lg font-bold text-orange-700">${formatDateTime(data.end_time)}</p>
            </div>
        </div>
        ${data.room && data.room.location ? `<div class="bg-gray-50 p-4 rounded-lg"><p class="text-sm font-medium text-gray-900 mb-2">📍 Localisation</p><p class="text-gray-700">${data.room.location}</p></div>` : ''}
        ${data.room && data.room.capacity ? `<div class="bg-gray-50 p-4 rounded-lg"><p class="text-sm font-medium text-gray-900 mb-2">👥 Capacité</p><p class="text-gray-700">${data.room.capacity} personnes</p></div>` : ''}
        ${data.purpose ? `<div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-400"><p class="text-sm font-medium text-yellow-900 mb-2">💡 Motif</p><p class="text-gray-700">${data.purpose}</p></div>` : ''}
        ${data.materials && data.materials.length > 0 ? `<div class="bg-blue-50 p-4 rounded-lg"><p class="text-sm font-semibold text-blue-900 mb-3">📦 Matériels réservés</p><ul class="space-y-2">${data.materials.map(m => `<li class="flex items-center justify-between bg-white p-3 rounded"><span class="font-medium">${m.name}</span><span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded">Quantité: ${m.pivot.quantity}</span></li>`).join('')}</ul></div>` : ''}
        ${data.status === 'rejected' && data.rejection_reason ? `<div class="bg-red-50 p-4 rounded-lg border-l-4 border-red-400"><p class="text-sm font-semibold text-red-900 mb-2">❌ Motif du rejet</p><p class="text-red-800 mb-2">${data.rejection_reason}</p>${data.admin ? `<p class="text-xs text-red-600">Par: ${data.admin.firstname} ${data.admin.lastname}</p>` : ''}</div>` : ''}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-lg">
            <div class="flex items-center justify-between">
                <div><p class="text-sm text-gray-600">Référence</p><p class="font-bold text-gray-900">${data.reference}</p></div>
                <div class="text-right"><p class="text-sm text-gray-600">Statut</p><span class="px-3 py-1 text-xs font-semibold rounded-full ${getStatusClass(data.status)}">${getStatusText(data.status)}</span></div>
            </div>
        </div>
    `;
    modal.classList.remove('hidden');
}

function closeDetailsModal() { document.getElementById('detailsModal').classList.add('hidden'); }

// ✅ Modal Modification - CORRIGÉ
function openEditModal(reservationId) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    const content = document.getElementById('editContent');
    
    // ✅ CORRECTION: Utiliser url() de Blade
    const baseUrl = "{{ url('enseignant/reservations') }}";
    form.action = baseUrl + '/' + reservationId;
    console.log('✅ Form action:', form.action); // Debug
    
    let data = null;
    document.querySelectorAll('.reservation-item').forEach(item => {
        try {
            const reservationData = JSON.parse(item.dataset.reservation);
            if (reservationData.id === reservationId) data = reservationData;
        } catch (e) { console.error('Erreur parsing:', e); }
    });
    
    if (!data) { alert('⚠️ Erreur lors du chargement des données'); return; }
    
    const startDateTime = new Date(data.start_time);
    const endDateTime = new Date(data.end_time);
    const startDate = startDateTime.toISOString().split('T')[0];
    const startTime = startDateTime.toTimeString().substring(0, 5);
    const endTime = endDateTime.toTimeString().substring(0, 5);
    const duration = calculateDuration(startTime, endTime);
    
    content.innerHTML = `
        <div class="bg-blue-50 p-4 rounded-lg mb-4">
            <p class="text-sm font-medium text-blue-900">Réservation de: <strong>${data.room ? data.room.name : 'Matériel'}</strong></p>
            <p class="text-xs text-blue-700 mt-1">Référence: ${data.reference}</p>
        </div>
        <div class="space-y-4">
            <div>
                <label for="edit_reservation_date" class="block text-sm font-medium text-gray-700 mb-2">📅 Date <span class="text-red-500">*</span></label>
                <input type="date" id="edit_reservation_date" name="reservation_date" value="${startDate}" required min="${new Date().toISOString().split('T')[0]}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="edit_start_time" class="block text-sm font-medium text-gray-700 mb-2">⏰ Heure début <span class="text-red-500">*</span></label>
                    <input type="time" id="edit_start_time" name="start_time" value="${startTime}" required onchange="updateEditEndTime()"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="edit_end_time" class="block text-sm font-medium text-gray-700 mb-2">⏱️ Heure fin</label>
                    <input type="time" id="edit_end_time" name="end_time" value="${endTime}" required readonly
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 cursor-not-allowed">
                </div>
            </div>
            <div>
                <label for="edit_duration" class="block text-sm font-medium text-gray-700 mb-2">⏳ Durée <span class="text-red-500">*</span></label>
                <select id="edit_duration" name="duration" required onchange="updateEditEndTime()"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    <option value="1" ${duration == 1 ? 'selected' : ''}>1 heure</option>
                    <option value="2" ${duration == 2 ? 'selected' : ''}>2 heures</option>
                    <option value="3" ${duration == 3 ? 'selected' : ''}>3 heures</option>
                    <option value="4" ${duration == 4 ? 'selected' : ''}>4 heures (demi-journée)</option>
                    <option value="8" ${duration == 8 ? 'selected' : ''}>8 heures (journée complète)</option>
                </select>
            </div>
            <div>
                <label for="edit_purpose" class="block text-sm font-medium text-gray-700 mb-2">💡 Motif <span class="text-red-500">*</span></label>
                <textarea id="edit_purpose" name="purpose" rows="4" required maxlength="500"
                          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 resize-none"
                          placeholder="Ex: Cours de programmation...">${data.purpose || ''}</textarea>
                <p class="text-xs text-gray-500 mt-1">Maximum 500 caractères</p>
            </div>
            ${data.materials && data.materials.length > 0 ? `
                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400">
                    <p class="text-sm font-semibold text-blue-900 mb-2">📦 Matériels réservés:</p>
                    <ul class="text-sm text-blue-800 space-y-1">
                        ${data.materials.map(m => `<li class="flex items-center"><svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>${m.name} (Qté: ${m.pivot.quantity})</li>`).join('')}
                    </ul>
                    <p class="text-xs text-blue-600 mt-2">ℹ️ Les matériels ne peuvent pas être modifiés ici</p>
                </div>
            ` : ''}
            <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-400">
                <p class="text-sm text-yellow-800"><strong>⚠️ Important:</strong> Après modification, votre réservation sera remise en statut "En attente".</p>
            </div>
        </div>
    `;
    modal.classList.remove('hidden');
}

function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }

function updateEditEndTime() {
    const startTime = document.getElementById('edit_start_time').value;
    const duration = parseInt(document.getElementById('edit_duration').value);
    
    if (startTime && duration) {
        const [hours, minutes] = startTime.split(':');
        const startDate = new Date();
        startDate.setHours(parseInt(hours), parseInt(minutes));
        startDate.setHours(startDate.getHours() + duration);
        
        document.getElementById('edit_end_time').value = 
            `${String(startDate.getHours()).padStart(2, '0')}:${String(startDate.getMinutes()).padStart(2, '0')}`;
    }
}

// Fermer modals en cliquant dehors
window.onclick = function(event) {
    const detailsModal = document.getElementById('detailsModal');
    const editModal = document.getElementById('editModal');
    if (event.target == detailsModal) closeDetailsModal();
    if (event.target == editModal) closeEditModal();
}
</script>
@endsection