@extends('layouts.admin')

@section('title', 'Créer un utilisateur')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('admin.users.index') }}" class="hover:text-blue-600">Utilisateurs</a></li>
                <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg></li>
                <li class="text-gray-900 font-medium">Créer un utilisateur</li>
            </ol>
        </nav>

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <span class="text-4xl mr-3">👤</span>
                Créer un nouvel utilisateur
            </h1>
            <p class="mt-2 text-gray-600">Ajoutez un nouvel utilisateur à la plateforme</p>
        </div>

        {{-- Formulaire --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    
                    {{-- Firstname --}}
                    <div>
                        <label for="firstname" class="block text-sm font-semibold text-gray-700 mb-2">
                            Firstname <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="firstname" 
                               name="firstname" 
                               value="{{ old('firstname') }}"
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('firstname') @enderror"
                               placeholder="Ex: Jean">
                        @error('firstname')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                     {{-- Lastname --}}

                    <div>
                        <label for="lastname" class="block text-sm font-semibold text-gray-700 mb-2">
                            Lastname <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="lastname" 
                               name="lastname" 
                               value="{{ old('lastname') }}"
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lastname') @enderror"
                               placeholder="Ex: Dupont">
                        @error('lastname')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Adresse email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') @enderror"
                               placeholder="exemple@campus.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Telephone --}}
                    <div>
                        <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Telephone <span class="text-red-500">*</span>
                        </label>
                        <input type="telephone" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone') }}"
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('telephone') @enderror"
                               placeholder="exemple@campus.com">
                        @error('telephone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Rôle --}}
                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                            Rôle <span class="text-red-500">*</span>
                        </label>
                        <select id="role" 
                                name="role" 
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') @enderror">
                            <option value="">Sélectionner un rôle</option>
                            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>🎓 Étudiant</option>
                            <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>👨‍🏫 Enseignant</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>👑 Administrateur</option>
                        </select>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                                        
                    {{-- Mot de passe --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mot de passe <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') @enderror"
                               placeholder="Minimum 8 caractères">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Le mot de passe doit contenir au moins 8 caractères</p>
                    </div>

                    {{-- Info Box --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="h-5 w-5 text-blue-600 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-sm font-semibold text-blue-900">Informations sur les rôles</h3>
                                <ul class="mt-2 text-sm text-blue-700 space-y-1">
                                    <li>• <strong>Étudiant</strong> : Peut consulter les annonces</li>
                                    <li>• <strong>Enseignant</strong> : Peut créer et gérer ses annonces</li>
                                    <li>• <strong>Administrateur</strong> : Accès complet à la plateforme</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Boutons --}}
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Créer un utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection