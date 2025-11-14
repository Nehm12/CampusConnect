@extends('layouts.app')

@section('title', 'Modifier l\'annonce')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('enseignant.announcements.index') }}" class="hover:text-blue-600">Mes Annonces</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                <li class="text-gray-900 font-medium">Modifier l'annonce</li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <span class="text-4xl mr-3">✏️</span>
                Modifier l'annonce
            </h1>
            <p class="mt-2 text-gray-600">Modifiez les informations de votre annonce</p>
        </div>

        {{-- Formulaire --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <form action="{{ route('enseignant.announcements.update', $announcement) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    
                    {{-- Titre --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Titre de l'annonce <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $announcement->title) }}"
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') @enderror"
                               placeholder="Ex: Nouvel horaire des cours...">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Catégorie --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Catégorie
                        </label>
                        <select id="category_id" 
                                name="category_id" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') @enderror">
                            <option value="">Sélectionner une catégorie (optionnel)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $announcement->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Contenu --}}
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Contenu de l'annonce <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="8" 
                                  required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('description') @enderror"
                                  placeholder="Rédigez le contenu de votre annonce ici...">{{ old('description', $announcement->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info métadonnées --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center text-sm text-gray-600 space-x-6">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>Créée le {{ $announcement->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                            <!-- <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span>{{ $announcement->views }} vues</span>
                            </div> -->
                        </div>
                    </div>
                </div>
                
                {{-- Boutons --}}
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <div>
                        <button type="button" 
                                onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')) { document.getElementById('delete-form').submit(); }"
                                class="px-6 py-3 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-colors duration-200 font-medium">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer
                        </button>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('enseignant.announcements.index') }}"
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </div>
            </form>

            {{-- Formulaire de suppression caché --}}
            <form id="delete-form" 
                  action="{{ route('enseignant.announcements.destroy', $announcement) }}" 
                  method="POST" 
                  class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection