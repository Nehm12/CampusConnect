@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header avec bouton d'ajout -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Gestion des utilisateurs</h1>
                    <p class="text-gray-600">Gérez les comptes utilisateurs du système</p>
                </div>
                <a href="{{ route('admin.users.create') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    + Nouvel utilisateur
                </a>
            </div>
        </div>

        <!-- Filtres -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="role_filter" class="block text-sm font-medium text-gray-700 mb-2">Filtrer par rôle</label>
                    <select id="role_filter" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="enseignant">Enseignant</option>
                        <option value="etudiant">Étudiant</option>
                    </select>
                </div>
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                    <input type="text" 
                           id="search" 
                           placeholder="Nom, email..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="flex items-end">
                    <button class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Rechercher
                    </button>
                </div>
            </div>
        </div>

        <!-- Liste des utilisateurs -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Liste des utilisateurs</h2>
                
                <!-- Table des utilisateurs -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Nom</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Rôle</th>
                                <th class="px-6 py-3">Statut</th>
                                <th class="px-6 py-3">Date création</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Exemple d'utilisateur -->
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    John Doe
                                </td>
                                <td class="px-6 py-4">john.doe@example.com</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                        Enseignant
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Actif
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ date('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.users.edit', 1) }}" 
                                           class="text-blue-600 hover:text-blue-800">Modifier</a>
                                        <button class="text-red-600 hover:text-red-800">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection