@extends('layouts.app')

@section('title', 'Mes Annonces - Administrateur')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📢 Mes Annonces</h1>
                    <p class="mt-2 text-gray-600">Gérez les annonces publiées</p>
                </div>
                <a href="{{ route('enseignant.announcements.create') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Créer une annonce
                </a>
            </div>
        </div>

        {{-- Liste des annonces --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                <h2 class="text-xl font-bold text-blue-900">Toutes les annonces</h2>
            </div>
            

        </div>
    </div>
</div>
@endsection