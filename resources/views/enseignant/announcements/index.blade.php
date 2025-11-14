@extends('layouts.app')

@section('title', 'Mes Annonces - Enseignant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📢 Mes Annonces</h1>
                    <p class="mt-2 text-gray-600">Gérez vos annonces publiées</p>
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
                <h2 class="text-xl font-bold text-blue-900">Toutes mes annonces</h2>
            </div>
            
            <div class="p-6">
                @forelse($announcements as $announcement)
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-4 hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        📢 Ma Publication
                                    </span>
                                    <span class="text-gray-500 text-sm">{{ $announcement->created_at->diffForHumans() }}</span>
                                    @if($announcement->category)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            {{ $announcement->category->name }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $announcement->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($announcement->description, 150) }}</p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span>{{ $announcement->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2 ml-4">
                                <a href="{{ route('enseignant.announcements.show', $announcement) }}"
                                   class="text-green-600 hover:text-green-800 text-sm font-medium px-3 py-1 rounded hover:bg-green-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune annonce</h3>
                        <p class="text-gray-500 mb-6">Vous n'avez pas encore publié d'annonces</p>
                        <a href="{{ route('enseignant.announcements.create') }}"
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 inline-block">
                            Créer ma première annonce
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection