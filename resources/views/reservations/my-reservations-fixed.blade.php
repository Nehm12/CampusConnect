@extends('layouts.reservations')

@section('title', 'Mes réservations')

@section('header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mes réservations</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Historique et statut de vos réservations
        </p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('reservations.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Nouvelle réservation
        </a>
    </div>
</div>
@endsection

@section('content')
<!-- Test simple -->
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-medium mb-4">Test des boutons</h2>
    <div class="space-x-4">
        <button id="test-details" class="px-4 py-2 bg-blue-600 text-white rounded">Détails</button>
        <button id="test-modifier" class="px-4 py-2 bg-green-600 text-white rounded">Modifier</button>
        <button id="test-nouvelle" class="px-4 py-2 bg-purple-600 text-white rounded">Nouvelle demande</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Test simple
    document.getElementById('test-details').addEventListener('click', function() {
        alert('Bouton Détails fonctionne !');
    });
    
    document.getElementById('test-modifier').addEventListener('click', function() {
        alert('Bouton Modifier fonctionne !');
    });
    
    document.getElementById('test-nouvelle').addEventListener('click', function() {
        alert('Bouton Nouvelle demande fonctionne !');
    });
});
</script>
@endpush