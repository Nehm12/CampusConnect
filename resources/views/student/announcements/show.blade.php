@extends('layouts.student')

@section('title', $announcement->title)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('student.dashboard') }}" class="hover:text-blue-600">Accueil</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                <li><a href="{{ route('student.announcements.index') }}" class="hover:text-blue-600">Annonces</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                <li class="text-gray-900 font-medium truncate max-w-xs">{{ Str::limit($announcement->title, 30) }}</li>
            </ol>
        </nav>

        {{-- Bouton Retour --}}
        <div class="mb-6">
            <a href="{{ route('student.announcements.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour aux annonces
            </a>
        </div>

        {{-- Contenu Principal --}}
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden mb-8">
            
            {{-- Header de l'annonce --}}
            <div class="px-8 py-8 bg-gradient-to-r from-blue-600 to-purple-600">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-4">
                            @if($announcement->category)
                                <span class="px-4 py-2 text-sm font-bold rounded-full bg-white text-blue-600 shadow-lg">
                                    🏷️ {{ $announcement->category->name }}
                                </span>
                            @endif
                            <span class="px-4 py-2 text-sm font-bold rounded-full bg-white/20 text-white backdrop-blur-sm">
                                📢 Annonce
                            </span>
                        </div>
                        <h1 class="text-4xl font-black text-white mb-4 leading-tight">
                            {{ $announcement->title }}
                        </h1>
                    </div>
                </div>
                
                {{-- Métadonnées --}}
                <div class="flex flex-wrap items-center gap-6 text-white/90">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-blue-600 text-lg font-bold mr-3">
                            {{ strtoupper(substr($announcement->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-xs text-white/70">Publié par</p>
                            <p class="font-bold text-white">{{ $announcement->user->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Date</p>
                            <p class="font-bold">{{ $announcement->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-white/70">Il y a</p>
                            <p class="font-bold">{{ $announcement->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contenu --}}
            <div class="px-8 py-12">
                <div class="prose prose-lg max-w-none">
                    <div class="text-gray-800 text-lg leading-relaxed whitespace-pre-line">
                        {{ $announcement->description }}
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
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
                </div>
            </div>
        </div>

        {{-- Informations sur l'auteur --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                <span class="mr-3">👨‍🏫</span>
                À propos de l'enseignant/administrateur
            </h2>
            <div class="flex items-start space-x-6">
                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-3xl font-bold flex-shrink-0 shadow-xl">
                    {{ strtoupper(substr($announcement->user->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $announcement->user->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $announcement->user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection