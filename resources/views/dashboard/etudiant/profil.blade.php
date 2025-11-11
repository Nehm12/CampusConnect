@extends('layouts.app')

@section('title', 'Modifier mon Profil - Étudiant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('etudiant.profil') }}" class="mr-4 text-blue-600 hover:text-blue-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">✏️ Modifier mon Profil</h1>
                    <p class="mt-2 text-gray-600">Mettez à jour vos informations personnelles</p>
                </div>
            </div>
        </div>

        {{-- Messages de succès/erreur --}}
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulaire de modification du profil --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Informations Personnelles</h2>
            </div>
            
            <form method="POST" action="{{ route('etudiant.profil.update') }}" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Prénom --}}
                    <div>
                        <label for="firstname" class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                        <input 
                            type="text" 
                            name="firstname" 
                            id="firstname"
                            value="{{ old('firstname', auth()->user()->firstname) }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('firstname') border-red-300 @enderror"
                        >
                        @error('firstname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nom --}}
                    <div>
                        <label for="lastname" class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                        <input 
                            type="text" 
                            name="lastname" 
                            id="lastname"
                            value="{{ old('lastname', auth()->user()->lastname) }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lastname') border-red-300 @enderror"
                        >
                        @error('lastname')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email *</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-300 @enderror"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="flex items-center justify-end space-x-4 mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ route('etudiant.profil') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Sauvegarder les modifications
                    </button>
                </div>
            </form>
        </div>

        {{-- Formulaire de changement de mot de passe --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Changer le Mot de Passe</h2>
            </div>
            
            <form method="POST" action="{{ route('etudiant.profil.password') }}" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    {{-- Mot de passe actuel --}}
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel *</label>
                        <input 
                            type="password" 
                            name="current_password" 
                            id="current_password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-300 @enderror"
                        >
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nouveau mot de passe --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe *</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-300 @enderror"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirmation du mot de passe --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe *</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="flex items-center justify-end space-x-4 mt-6 pt-6 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection