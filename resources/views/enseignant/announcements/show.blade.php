@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('enseignant.announcements.index') }}" class="hover:text-blue-600">Mes Annonces</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                <li class="text-gray-900 font-medium">Détails de l'annonce</li>
            </ol>
        </nav>

        {{-- Contenu principal --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            
            {{-- Header de l'annonce --}}
            <div class="px-8 py-6 border-b border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            @if($announcement->category)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 border border-green-200">
                                    {{ $announcement->category->name }}
                                </span>
                            @endif
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                📢 Ma Publication
                            </span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $announcement->title }}
                        </h1>
                    </div>
                </div>
                
                {{-- Métadonnées --}}
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $announcement->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Publié le {{ $announcement->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $announcement->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            {{-- Contenu --}}
            <div class="px-8 py-8">
                <div class="prose max-w-none">
                    <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                        {{ $announcement->description }}
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 rounded-b-xl">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        @if($announcement->updated_at->ne($announcement->created_at))
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Dernière modification : {{ $announcement->updated_at->format('d/m/Y à H:i') }}
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('enseignant.announcements.index') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour à mes annonces
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection