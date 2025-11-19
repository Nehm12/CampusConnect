@extends('layouts.app')

@section('title', 'Salles & Matériels - Enseignant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Messages de feedback --}}
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
                    <h1 class="text-3xl font-bold text-gray-900">🏢 Salles & Matériels</h1>
                    <p class="mt-2 text-gray-600">Réservez des salles et du matériel pour vos cours</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button 
                        onclick="window.location.href='{{ route('enseignant.reservations') }}'"
                        class="bg-green-600 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Mes Réservations
                    </button>
                </div>
            </div>
        </div>

        {{-- ✅ Statistiques dynamiques --}}
        @php
            // Calculer dynamiquement les salles disponibles
            $availableRooms = collect($rooms ?? [])->filter(function($room) {
                return $room->is_available && !$room->current_reservation;
            })->count();
            
            // Calculer dynamiquement les matériels disponibles
            $availableMaterials = collect($materials ?? [])->filter(function($material) {
                return $material->is_available && $material->available_quantity > 0;
            })->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Salles Disponibles</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $availableRooms }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Matériel Disponible</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $availableMaterials }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Mes Réservations</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['my_reservations'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Onglets --}}
        <div class="mb-8">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab('rooms')" id="rooms-tab" 
                            class="border-b-2 border-blue-500 text-blue-600 py-4 px-1 text-sm font-medium whitespace-nowrap">
                        🏢 Salles ({{ count($rooms ?? []) }})
                    </button>
                    <button onclick="showTab('materials')" id="materials-tab" 
                            class="border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium whitespace-nowrap">
                        🎯 Matériel ({{ count($materials ?? []) }})
                    </button>
                </nav>
            </div>
        </div>

        {{-- Section Salles --}}
        <div id="rooms-content" class="tab-content">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                    <h2 class="text-xl font-bold text-blue-900">Salles disponibles</h2>
                </div>
                
                <div class="p-6">
                    @forelse($rooms ?? [] as $room)
                        @php
                            $isAvailable = $room->is_available && !$room->current_reservation;
                        @endphp
                        
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-4 hover:shadow-md transition-all duration-200 
                                    {{ $isAvailable ? '' : 'bg-red-50 border-red-200' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $room->name }}</h3>
                                        @if($room->code)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                                {{ $room->code }}
                                            </span>
                                        @endif
                                        
                                        @if($isAvailable)
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                ✅ Disponible
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                                ❌ Indisponible
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-gray-600 mb-3">
                                        👥 Capacité: {{ $room->capacity }} personnes
                                    </p>
                                    
                                    @if($room->location)
                                        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                📍 {{ $room->location }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if($room->current_reservation)
                                        <div class="mt-3 bg-red-50 p-3 rounded-lg border border-red-200">
                                            <p class="text-sm font-semibold text-red-900 mb-1">🔒 Actuellement réservée</p>
                                            <p class="text-sm text-red-800">
                                                Par: <strong>{{ $room->current_reservation->user->firstname }} {{ $room->current_reservation->user->lastname }}</strong>
                                            </p>
                                            <p class="text-xs text-red-600 mt-1">
                                                Jusqu'à: {{ \Carbon\Carbon::parse($room->current_reservation->end_time)->format('d/m/Y à H:i') }}
                                            </p>
                                        </div>
                                    @endif
                                    
                                    @if($room->next_reservation)
                                        <div class="mt-3 bg-orange-50 p-3 rounded-lg border border-orange-300">
                                            <p class="text-sm font-semibold text-orange-900 mb-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                Prochaine réservation
                                            </p>
                                            <p class="text-xs text-orange-800">
                                                Le {{ \Carbon\Carbon::parse($room->next_reservation->start_time)->format('d/m/Y à H:i') }}
                                            </p>
                                            <p class="text-xs text-orange-700 mt-1">
                                                Par: <strong>{{ $room->next_reservation->user->firstname }} {{ $room->next_reservation->user->lastname }}</strong>
                                            </p>
                                        </div>
                                    @endif
                                    
                                    @if($room->notes)
                                        <p class="text-sm text-gray-500 mt-3">💡 {{ $room->notes }}</p>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2 ml-4">
                                    @if($isAvailable)
                                        <button 
                                            onclick="openReservationModal('room', {{ $room->id }}, '{{ addslashes($room->name) }}')"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Réserver
                                        </button>
                                    @else
                                        <button disabled
                                            class="bg-gray-400 text-white px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed opacity-60">
                                            ❌ Indisponible
                                        </button>
                                    @endif
                                    
                                    <button 
                                        onclick="showRoomSchedule({{ $room->id }}, '{{ addslashes($room->name) }}')"
                                        class="bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors duration-200">
                                        📅 Planning
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune salle disponible</h3>
                            <p class="text-gray-500">Aucune salle n'est actuellement disponible pour réservation</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Section Matériel --}}
        <div id="materials-content" class="tab-content hidden">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-green-100 rounded-t-xl">
                    <h2 class="text-xl font-bold text-green-900">Matériel disponible</h2>
                </div>
                
                <div class="p-6">
                    @forelse($materials ?? [] as $material)
                        @php
                            $totalReserved = $material->quantity_total - $material->available_quantity;
                            $isAvailable = $material->is_available && $material->available_quantity > 0;
                        @endphp
                        
                        <div class="border border-gray-200 rounded-lg p-5 mb-4 hover:shadow-md transition-shadow
                                    {{ $isAvailable ? 'bg-white' : 'bg-gray-50' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-lg font-bold text-gray-900">{{ $material->name }}</h3>
                                        @if($material->code)
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-gray-100 text-gray-700">
                                                {{ $material->code }}
                                            </span>
                                        @endif
                                        
                                        @if($isAvailable)
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-700">
                                                {{ $material->available_quantity }} disponible(s)
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium rounded bg-red-100 text-red-700">
                                                Épuisé
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-6 text-sm text-gray-600 mb-3">
                                        <span>📦 <strong>Stock:</strong> {{ $material->quantity_total }}</span>
                                        <span>✅ <strong>Dispo:</strong> {{ $material->available_quantity }}</span>
                                        <span>🔒 <strong>Réservé:</strong> {{ $totalReserved }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full transition-all {{ $material->available_quantity > 0 ? 'bg-green-500' : 'bg-red-500' }}" 
                                                 style="width: {{ $material->quantity_total > 0 ? ($material->available_quantity / $material->quantity_total) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($material->category)
                                        <p class="text-sm text-gray-500 mb-2">🏷️ {{ $material->category }}</p>
                                    @endif
                                    
                                    @if(isset($material->current_reservations) && count($material->current_reservations) > 0)
                                        <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded p-3">
                                            <p class="text-sm font-semibold text-yellow-900 mb-2">
                                                🔒 Réservé actuellement ({{ count($material->current_reservations) }})
                                            </p>
                                            @foreach($material->current_reservations as $reservation)
                                                <div class="text-xs text-yellow-800 border-t border-yellow-200 pt-2 mt-2 first:border-t-0 first:pt-0 first:mt-0">
                                                    <div class="flex justify-between items-center">
                                                        <span>👤 {{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</span>
                                                        <span class="font-bold bg-yellow-200 px-2 py-0.5 rounded">
                                                            {{ $reservation->quantity ?? 1 }} unité(s)
                                                        </span>
                                                    </div>
                                                    <p class="text-yellow-600 mt-1">
                                                        📅 Jusqu'au {{ \Carbon\Carbon::parse($reservation->end_time)->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    @if(isset($material->next_reservation))
                                        <div class="mt-3 bg-blue-50 border border-blue-200 rounded p-3">
                                            <p class="text-sm font-semibold text-blue-900">
                                                📅 Prochaine: {{ \Carbon\Carbon::parse($material->next_reservation->start_time)->format('d/m/Y H:i') }}
                                            </p>
                                            <p class="text-xs text-blue-700 mt-1">
                                                <strong>{{ $material->next_reservation->quantity ?? 1 }} unité(s)</strong> - 
                                                {{ $material->next_reservation->user->firstname }} {{ $material->next_reservation->user->lastname }}
                                            </p>
                                        </div>
                                    @endif
                                    
                                    @if($material->description)
                                        <p class="text-sm text-gray-500 mt-3">{{ $material->description }}</p>
                                    @endif
                                </div>
                                
                                <div class="ml-4">
                                    @if($isAvailable)
                                        <button 
                                            onclick="openReservationModal('material', {{ $material->id }}, '{{ addslashes($material->name) }}', {{ $material->available_quantity }})"
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                            Emprunter
                                        </button>
                                    @else
                                        <button disabled
                                            class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm font-medium cursor-not-allowed">
                                            Indisponible
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-700 mb-1">Aucun matériel disponible</h3>
                            <p class="text-gray-500 text-sm">Revenez plus tard</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal de réservation --}}
<div id="reservationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-2xl font-bold text-gray-900">📅 Faire une réservation</h3>
                <button 
                    onclick="document.getElementById('reservationModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="reservationForm" method="POST" class="mt-6">
                @csrf
                <input type="hidden" id="reservation_type" name="type">
                <input type="hidden" id="resource_id" name="resource_id">
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ressource sélectionnée</label>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p id="selected_resource" class="text-blue-900 font-medium"></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="reservation_date" class="block text-sm font-medium text-gray-700 mb-2">Date de réservation</label>
                            <input type="date" id="reservation_date" name="reservation_date" required 
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Durée (heures)</label>
                            <select id="duration" name="duration" required 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionnez la durée</option>
                                <option value="1">1 heure</option>
                                <option value="2">2 heures</option>
                                <option value="3">3 heures</option>
                                <option value="4">4 heures (demi-journée)</option>
                                <option value="8">8 heures (journée complète)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Heure de début</label>
                            <input type="time" id="start_time" name="start_time" required 
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">Heure de fin</label>
                            <input type="time" id="end_time" name="end_time" required readonly
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">Motif de la réservation</label>
                        <textarea id="purpose" name="purpose" rows="3" required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="Ex: Cours de programmation, Réunion pédagogique, Examen..."></textarea>
                    </div>
                    
                    <div id="quantity_section" class="hidden">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantité demandée</label>
                        <input type="number" id="quantity" name="quantity" min="1" 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p id="quantity_hint" class="mt-1 text-sm text-gray-500"></p>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <button type="button" 
                            onclick="document.getElementById('reservationModal').classList.add('hidden')"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        📅 Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Planning Salle --}}
<div id="scheduleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-4xl shadow-lg rounded-xl bg-white mb-10">
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h3 id="scheduleModalTitle" class="text-2xl font-bold text-gray-900">📅 Planning de la salle</h3>
            <button onclick="closeScheduleModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold leading-none">×</button>
        </div>
        <div id="scheduleContent" class="space-y-4">
            <p class="text-gray-600">🔄 Fonctionnalité de planning détaillé à implémenter</p>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
    document.querySelectorAll('[id$="-tab"]').forEach(tab => {
        tab.classList.remove('border-blue-500', 'text-blue-600');
        tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    });
    document.getElementById(tabName + '-content').classList.remove('hidden');
    const activeTab = document.getElementById(tabName + '-tab');
    activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    activeTab.classList.add('border-blue-500', 'text-blue-600');
}

function openReservationModal(type, resourceId, resourceName, maxQuantity = null) {
    document.getElementById('reservation_type').value = type;
    document.getElementById('resource_id').value = resourceId;
    document.getElementById('selected_resource').textContent = `${type === 'room' ? 'Salle' : 'Matériel'}: ${resourceName}`;
    
    if (type === 'material') {
        document.getElementById('quantity_section').classList.remove('hidden');
        const quantityInput = document.getElementById('quantity');
        quantityInput.required = true;
        
        if (maxQuantity) {
            quantityInput.max = maxQuantity;
            quantityInput.value = 1;
            document.getElementById('quantity_hint').textContent = `Maximum ${maxQuantity} disponible(s)`;
        }
    } else {
        document.getElementById('quantity_section').classList.add('hidden');
        document.getElementById('quantity').required = false;
    }
    
    document.getElementById('reservationForm').action = `{{ route('enseignant.reservations.store') }}`;
    document.getElementById('reservationModal').classList.remove('hidden');
}

function showRoomSchedule(roomId, roomName) {
    const modal = document.getElementById('scheduleModal');
    document.getElementById('scheduleModalTitle').textContent = `📅 Planning de ${roomName}`;
    document.getElementById('scheduleContent').innerHTML = `
        <div class="text-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-4 text-gray-600">Chargement du planning...</p>
        </div>
    `;
    modal.classList.remove('hidden');
    
    setTimeout(() => {
        document.getElementById('scheduleContent').innerHTML = `
            <p class="text-gray-600 mb-4">🔄 Fonctionnalité de planning détaillé à implémenter</p>
            <p class="text-sm text-gray-500">Cela nécessitera une route API pour récupérer toutes les réservations futures de cette salle.</p>
        `;
    }, 1000);
}

function closeScheduleModal() {
    document.getElementById('scheduleModal').classList.add('hidden');
}

document.getElementById('start_time').addEventListener('change', calculateEndTime);
document.getElementById('duration').addEventListener('change', calculateEndTime);

function calculateEndTime() {
    const startTime = document.getElementById('start_time').value;
    const duration = parseInt(document.getElementById('duration').value);
    
    if (startTime && duration) {
        const [hours, minutes] = startTime.split(':');
        const startDate = new Date();
        startDate.setHours(parseInt(hours), parseInt(minutes), 0, 0);
        const endDate = new Date(startDate.getTime() + (duration * 60 * 60 * 1000));
        document.getElementById('end_time').value = endDate.toTimeString().slice(0, 5);
    }
}

window.onclick = function(event) {
    const reservationModal = document.getElementById('reservationModal');
    const scheduleModal = document.getElementById('scheduleModal');
    if (event.target === reservationModal) reservationModal.classList.add('hidden');
    if (event.target === scheduleModal) scheduleModal.classList.add('hidden');
}
</script>
@endsection