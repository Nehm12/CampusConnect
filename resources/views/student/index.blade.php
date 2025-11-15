@extends('layouts.student')

@section('title', 'Dashboard Étudiant')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">👋 Bienvenue, {{ auth()->user()->name }} !</h1>
            <p class="mt-2 text-gray-600 text-lg">Consultez les dernières annonces</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            {{-- Annonces Récentes --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <span class="mr-3">📢</span>
                            Dernières Annonces
                        </h2>
                        <a href="{{ route('student.announcements.index') }}" 
                           class="text-white hover:text-blue-100 text-sm font-medium transition-colors duration-200">
                            Voir tout →
                        </a>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($recentAnnouncements as $announcement)
                                <a href="{{ route('student.announcements.show', $announcement) }}" 
                                   class="block group">
                                    <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-5 hover:border-blue-400 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3 mb-3">
                                                    @if($announcement->category)
                                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                                                            {{ $announcement->category->name }}
                                                        </span>
                                                    @endif
                                                    <span class="text-sm text-gray-500">{{ $announcement->created_at->diffForHumans() }}</span>
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                                    {{ $announcement->title }}
                                                </h3>
                                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($announcement->description, 120) }}</p>
                                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                                    <span class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        {{ $announcement->user->name }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="mt-4 text-gray-500">Aucune annonce disponible</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Catégories --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-orange-500 to-red-500">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <span class="mr-2">🏷️</span>
                            Catégories
                        </h3>
                    </div>
                    <div class="p-4">
                        @forelse($categories as $category)
                            <a href="{{ route('student.announcements.index', ['category' => $category->id]) }}" 
                               class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200 group">
                                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600">{{ $category->name }}</span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold group-hover:bg-blue-100 group-hover:text-blue-600">
                                    {{ $category->announcements_count }}
                                </span>
                            </a>
                        @empty
                            <p class="text-center text-gray-500 py-4 text-sm">Aucune catégorie</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="text-center">
            <a href="{{ route('student.announcements.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <span class="mr-2">📚</span>
                Voir Toutes les Annonces
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection