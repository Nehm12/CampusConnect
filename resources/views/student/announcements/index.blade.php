@extends('layouts.student')

@section('title', 'Toutes les Annonces')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">📢 Toutes les Annonces</h1>
            <p class="mt-2 text-gray-600 text-lg">Consultez les dernières annonces</p>
        </div>

        {{-- Filtres et Recherche --}}
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-100">
            <form method="GET" action="{{ route('student.announcements.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Recherche --}}
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">🔍 Rechercher</label>
                        <input type="text" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Titre ou contenu..."
                               class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    </div>

                    {{-- Catégorie --}}
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">🏷️ Catégorie</label>
                        <select id="category" 
                                name="category" 
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="">Toutes</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->announcements_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Auteur --}}
                    <div>
                        <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">👨‍🏫 Enseignant</label>
                        <select id="author" 
                                name="author" 
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="">Tous</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }} ({{ $author->announcements_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    {{-- Tri --}}
                    <div class="flex-1 min-w-[200px]">
                        <label for="sort" class="block text-sm font-semibold text-gray-700 mb-2">⚡ Trier par</label>
                        <select id="sort" 
                                name="sort" 
                                class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Plus récentes</option>
                            <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Plus anciennes</option>
                            <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Titre A → Z</option>
                            <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Titre Z → A</option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex gap-3 items-end">
                        <button type="submit" 
                                class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold shadow-md hover:shadow-lg">
                            Filtrer
                        </button>
                        <a href="{{ route('student.announcements.index') }}" 
                           class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-semibold">
                            Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Résultats --}}
        <div class="mb-4 flex items-center justify-between">
            <p class="text-gray-600">
                <span class="font-semibold text-gray-900">{{ $announcements->total() }}</span> annonce(s) trouvée(s)
            </p>
            @if(request()->hasAny(['search', 'category', 'author']))
                <a href="{{ route('student.announcements.index') }}" 
                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    ✕ Effacer les filtres
                </a>
            @endif
        </div>

        {{-- Grille d'annonces --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($announcements as $announcement)
                <a href="{{ route('student.announcements.show', $announcement) }}" 
                   class="group block">
                    <div class="bg-white rounded-xl shadow-md border-2 border-gray-100 overflow-hidden hover:shadow-2xl hover:border-blue-400 transition-all duration-300 h-full flex flex-col">
                        {{-- Header --}}
                        <div class="p-6 flex-1">
                            <div class="flex items-center justify-between mb-4">
                                @if($announcement->category)
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-gradient-to-r from-green-400 to-green-500 text-white shadow-sm">
                                        {{ $announcement->category->name }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-200 text-gray-600">
                                        Non catégorisé
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500 font-medium">
                                    {{ $announcement->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $announcement->title }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $announcement->description }}
                            </p>
                        </div>

                        {{-- Footer --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold mr-2">
                                        {{ strtoupper(substr($announcement->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium">{{ $announcement->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow-md p-16 text-center border border-gray-200">
                        <svg class="mx-auto h-24 w-24 text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Aucune annonce trouvée</h3>
                        <p class="text-gray-600 mb-6">Essayez de modifier vos filtres ou revenez plus tard</p>
                        <a href="{{ route('student.announcements.index') }}" 
                           class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                            Réinitialiser les filtres
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection