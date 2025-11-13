@extends('layouts.app')

@section('title', 'Gestion des réservations')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
        
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8 space-y-4 sm:space-y-0">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 flex items-center">
                    <span class="text-3xl sm:text-4xl mr-2 sm:mr-3">📅</span>
                    <span class="hidden sm:inline">Gestion des Réservations</span>
                    <span class="sm:hidden">Réservations</span>
                </h1>
                <p class="mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base text-gray-600">Approuvez ou rejetez les demandes de réservation</p>
            </div>
        </div>

        {{-- Messages --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-fadeIn">
                <div class="flex items-start">
                    <span class="text-xl sm:text-2xl mr-2 sm:mr-3 flex-shrink-0">✅</span>
                    <p class="text-green-800 font-semibold text-xs sm:text-sm lg:text-base">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-fadeIn">
                <div class="flex items-start">
                    <span class="text-xl sm:text-2xl mr-2 sm:mr-3 flex-shrink-0">❌</span>
                    <p class="text-red-800 font-semibold text-xs sm:text-sm lg:text-base">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Filtres --}}
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6 border border-gray-200">
            <form method="GET" action="{{ route('admin.reservations') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">📊 Statut</label>
                    <select 
                        name="status" 
                        class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ En attente</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Approuvée</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Rejetée</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>🚫 Annulée</option>
                    </select>
                </div>

                <div class="flex items-end space-x-2">
                    <button 
                        type="submit" 
                        class="flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all shadow-md"
                    >
                        Filtrer
                    </button>
                    <a 
                        href="{{ route('admin.reservations') }}" 
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 sm:px-6 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all"
                    >
                        🔄
                    </a>
                </div>
            </form>
        </div>

        {{-- Liste des réservations --}}
        <div class="space-y-4">
            @forelse($reservations as $reservation)
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200 hover:shadow-xl transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-start space-x-3 flex-1">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ strtoupper(substr($reservation->user->firstname ?? 'U', 0, 1)) }}{{ strtoupper(substr($reservation->user->lastname ?? 'U', 0, 1)) }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900">
                                    {{ $reservation->user->firstname ?? 'Utilisateur' }} {{ $reservation->user->lastname ?? '' }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-2 mt-1 text-xs sm:text-sm text-gray-600">
                                    @if($reservation->room)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 font-semibold">
                                            🏛️ {{ $reservation->room->name }}
                                        </span>
                                    @endif
                                    @if($reservation->materials && $reservation->materials->isNotEmpty())
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-green-100 text-green-800 font-semibold">
                                            🔧 {{ $reservation->materials->count() }} matériel(s)
                                        </span>
                                    @endif
                                    <span class="text-gray-400">•</span>
                                    <span>📅 {{ \Carbon\Carbon::parse($reservation->start_time)->format('d/m/Y') }}</span>
                                    <span>⏰ {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Statut Badge --}}
                        <div class="ml-4 flex-shrink-0">
                            @if($reservation->status == 'pending')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">⏳ En attente</span>
                            @elseif($reservation->status == 'approved')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">✅ Approuvée</span>
                            @elseif($reservation->status == 'rejected')
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800">❌ Rejetée</span>
                            @else
                                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-800">🚫 Annulée</span>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($reservation->purpose)
                        <div class="bg-gray-50 rounded-lg p-3 mb-4">
                            <p class="text-sm text-gray-700">📝 <strong>Objectif :</strong> {{ $reservation->purpose }}</p>
                        </div>
                    @endif

                    {{-- Matériels réservés --}}
                    @if($reservation->materials && $reservation->materials->isNotEmpty())
                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                            <p class="text-xs font-semibold text-green-800 mb-2">🔧 Matériels réservés :</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($reservation->materials as $material)
                                    <span class="inline-flex items-center px-2 py-1 text-xs bg-white rounded-lg border border-green-300 text-green-800">
                                        {{ $material->name }} <span class="ml-1 font-bold">(x{{ $material->pivot->quantity ?? 1 }})</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-4 border-t border-gray-100 gap-3">
                        <span class="text-xs sm:text-sm text-gray-500">
                            Demandé le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                        </span>

                        <div class="flex flex-wrap items-center gap-2">
                            @if($reservation->status == 'pending')
                                {{-- Approuver --}}
                                <form action="{{ route('admin.reservations.approve', $reservation->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button 
                                        type="submit" 
                                        class="bg-green-50 hover:bg-green-100 text-green-700 px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all shadow-sm hover:shadow-md"
                                    >
                                        ✅ Approuver
                                    </button>
                                </form>
                                
                                {{-- Rejeter --}}
                                <form action="{{ route('admin.reservations.reject', $reservation->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button 
                                        type="submit" 
                                        class="bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all shadow-sm hover:shadow-md"
                                    >
                                        ❌ Rejeter
                                    </button>
                                </form>
                            @endif

                            {{-- Supprimer (toujours disponible) --}}
                            <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cette réservation ?')">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="bg-gray-50 hover:bg-gray-100 text-gray-700 px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all shadow-sm hover:shadow-md"
                                >
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-lg p-8 sm:p-12 text-center border border-gray-200">
                    <div class="text-6xl sm:text-8xl mb-4">📅</div>
                    <p class="text-gray-500 text-sm sm:text-base">Aucune réservation trouvée</p>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>
@endsection