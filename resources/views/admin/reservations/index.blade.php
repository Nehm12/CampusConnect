@extends('layouts.reservations')

@section('title', 'Validation des réservations')

@section('header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Validation des réservations</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Gérez les demandes de réservation en attente
        </p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center space-x-3">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
            <i data-lucide="clock" class="h-4 w-4 mr-1"></i>
            3 en attente
        </span>
    </div>
</div>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-md flex items-center justify-center">
                        <i data-lucide="clock" class="h-5 w-5 text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">En attente</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">3</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-md flex items-center justify-center">
                        <i data-lucide="check-circle" class="h-5 w-5 text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Approuvées aujourd'hui</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">8</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-md flex items-center justify-center">
                        <i data-lucide="x-circle" class="h-5 w-5 text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Rejetées aujourd'hui</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">2</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-md flex items-center justify-center">
                        <i data-lucide="calendar" class="h-5 w-5 text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total ce mois</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">45</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Reservations -->
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                Demandes en attente
            </h3>
            <div class="flex items-center space-x-2">
                <button class="inline-flex items-center px-3 py-1.5 border border-green-300 dark:border-green-600 shadow-sm text-sm font-medium rounded-md text-green-700 dark:text-green-300 bg-white dark:bg-gray-800 hover:bg-green-50 dark:hover:bg-green-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    <i data-lucide="check-circle" class="h-4 w-4 mr-1"></i>
                    Tout approuver
                </button>
                <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i data-lucide="filter" class="h-4 w-4 mr-1"></i>
                    Filtrer
                </button>
            </div>
        </div>
    </div>
    
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <!-- Pending Request 1 -->
        <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="h-5 w-5 text-blue-600 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Prof. Martin Dubois</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Demandé il y a 2 heures</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                            <i data-lucide="clock" class="h-3 w-3 mr-1"></i>
                            Urgent
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Salle</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">Salle A201 (Amphithéâtre)</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Heure</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">15 Nov 2024, 14:00-16:00</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motif</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">Cours magistral</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matériel</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">Projecteur, Microphone</dd>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="info" class="h-5 w-5 text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="text-sm font-medium text-blue-800 dark:text-blue-200">Description</h5>
                                <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">
                                    Cours de mathématiques avancées pour 80 étudiants. Besoin du projecteur pour les formules et du microphone pour l'acoustique.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conflict Check -->
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="text-sm font-medium text-green-800 dark:text-green-200">Vérification automatique</h5>
                                <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                                    ✅ Salle disponible • ✅ Matériel disponible • ✅ Aucun conflit détecté
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-2 ml-6">
                    <button class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                        Approuver
                    </button>
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                        Rejeter
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                        Détails
                    </button>
                </div>
            </div>
        </div>

        <!-- Pending Request 2 with Conflict -->
        <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="h-5 w-5 text-purple-600 dark:text-purple-400"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Dr. Sophie Laurent</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Demandé il y a 4 heures</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Salle</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">Salle C301 (Laboratoire)</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Heure</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">16 Nov 2024, 10:00-12:00</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motif</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">TP Chimie</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matériel</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">Ordinateurs (15)</dd>
                        </div>
                    </div>
                    
                    <!-- Conflict Warning -->
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="alert-triangle" class="h-5 w-5 text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="text-sm font-medium text-red-800 dark:text-red-200">Conflit détecté</h5>
                                <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                                    ⚠️ Salle déjà réservée de 09:00 à 11:00 • ❌ Seulement 10 ordinateurs disponibles (15 demandés)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-2 ml-6">
                    <button class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                        Modifier
                    </button>
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                        Rejeter
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i data-lucide="message-circle" class="h-4 w-4 mr-2"></i>
                        Contacter
                    </button>
                </div>
            </div>
        </div>

        <!-- Pending Request 3 -->
        <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="h-5 w-5 text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Prof. Jean Moreau</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Demandé il y a 1 jour</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Salle</dt>
                            <dd class="text-sm text-gray-900 dark:text-white font-medium">Salle B105 (Salle de cours)</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Heure</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">18 Nov 2024, 16:00-18:00</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motif</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">Soutenance</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matériel</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">Projecteur</dd>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-md p-3 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <h5 class="text-sm font-medium text-green-800 dark:text-green-200">Vérification automatique</h5>
                                <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                                    ✅ Salle disponible • ✅ Matériel disponible • ✅ Aucun conflit détecté
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-2 ml-6">
                    <button class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                        Approuver
                    </button>
                    <button class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                        Rejeter
                    </button>
                    <button class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                        Détails
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Actions -->
<div class="mt-8 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
            Actions récentes
        </h3>
    </div>
    <div class="divide-y divide-gray-200 dark:divide-gray-700">
        <div class="p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                    <i data-lucide="check" class="h-4 w-4 text-green-600 dark:text-green-400"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Réservation approuvée</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Salle A201 - Prof. Dubois - 15 Nov 2024</p>
                </div>
            </div>
            <span class="text-sm text-gray-500 dark:text-gray-400">Il y a 10 min</span>
        </div>
        <div class="p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                    <i data-lucide="x" class="h-4 w-4 text-red-600 dark:text-red-400"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Réservation rejetée</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Salle C301 - Dr. Martin - Conflit horaire</p>
                </div>
            </div>
            <span class="text-sm text-gray-500 dark:text-gray-400">Il y a 1h</span>
        </div>
    </div>
</div>
@endsection

<!-- Modals -->
<x-modal id="approve-modal" title="Confirmer l'approbation" size="md">
    <div class="text-center">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900 mb-4">
            <i data-lucide="check-circle" class="h-6 w-6 text-green-600 dark:text-green-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Approuver cette réservation ?</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Cette action enverra une notification de confirmation au demandeur.</p>
        <div class="flex justify-center space-x-3">
            <button type="button" 
                    class="modal-close inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Annuler
            </button>
            <button type="button" 
                    id="confirm-approve"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                Confirmer
            </button>
        </div>
    </div>
</x-modal>

<x-modal id="reject-modal" title="Rejeter la réservation" size="md">
    <div>
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 mb-4">
            <i data-lucide="x-circle" class="h-6 w-6 text-red-600 dark:text-red-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Motif du rejet</h3>
        <textarea id="reject-reason" 
                  rows="3" 
                  class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm mb-6" 
                  placeholder="Expliquez pourquoi cette réservation est rejetée..."></textarea>
        <div class="flex justify-end space-x-3">
            <button type="button" 
                    class="modal-close inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Annuler
            </button>
            <button type="button" 
                    id="confirm-reject"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i data-lucide="x" class="h-4 w-4 mr-2"></i>
                Rejeter
            </button>
        </div>
    </div>
</x-modal>

<!-- Notifications -->
<x-notification type="success" id="success-notification" />
<x-notification type="error" id="error-notification" />

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Approve/Reject buttons
    const approveButtons = document.querySelectorAll('button:has([data-lucide="check"])');
    const rejectButtons = document.querySelectorAll('button:has([data-lucide="x"])');
    
    let currentButton = null;
    
    approveButtons.forEach(button => {
        if (button.textContent.includes('Approuver')) {
            button.addEventListener('click', function() {
                currentButton = this;
                openModal('approve-modal');
            });
        }
    });
    
    // Confirm approve
    document.getElementById('confirm-approve').addEventListener('click', function() {
        if (currentButton) {
            const card = currentButton.closest('.p-6');
            card.style.opacity = '0.5';
            currentButton.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 mr-2 animate-spin"></i>Traitement...';
            currentButton.disabled = true;
            
            // Close modal
            document.getElementById('approve-modal').classList.add('hidden');
            
            setTimeout(() => {
                card.style.backgroundColor = '#f0fdf4';
                currentButton.innerHTML = '<i data-lucide="check" class="h-4 w-4 mr-2"></i>Approuvée';
                currentButton.className = 'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-75 cursor-not-allowed';
                
                // Show success notification
                showNotification('success', 'Réservation approuvée', 'La demande a été approuvée avec succès.');
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }, 1500);
        }
    });
    
    rejectButtons.forEach(button => {
        if (button.textContent.includes('Rejeter')) {
            button.addEventListener('click', function() {
                currentButton = this;
                openModal('reject-modal');
            });
        }
    });
    
    // Confirm reject
    document.getElementById('confirm-reject').addEventListener('click', function() {
        const reason = document.getElementById('reject-reason').value;
        if (currentButton) {
            const card = currentButton.closest('.p-6');
            card.style.opacity = '0.5';
            currentButton.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 mr-2 animate-spin"></i>Traitement...';
            currentButton.disabled = true;
            
            // Close modal
            document.getElementById('reject-modal').classList.add('hidden');
            
            setTimeout(() => {
                card.style.backgroundColor = '#fef2f2';
                currentButton.innerHTML = '<i data-lucide="x" class="h-4 w-4 mr-2"></i>Rejetée';
                currentButton.className = 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-75 cursor-not-allowed';
                
                // Show error notification
                showNotification('error', 'Réservation rejetée', reason || 'La demande a été rejetée.');
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }, 1500);
        }
    });
    
    // Enhanced notification system
    function showNotification(type, title, message) {
        // Create notification if it doesn't exist
        let notification = document.getElementById(type + '-notification');
        if (!notification) {
            // Create a temporary notification
            notification = document.createElement('div');
            notification.className = 'notification fixed top-4 right-4 z-50 transform transition-all duration-300 ease-in-out';
            notification.innerHTML = `
                <div class="max-w-sm w-full bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-50 dark:bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-900/20 border border-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-200 dark:border-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-800 text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-800 dark:text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-200 rounded-lg shadow-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : type === 'warning' ? 'alert-triangle' : 'info'}" class="h-5 w-5 text-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-400"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            <h4 class="text-sm font-medium">${title}</h4>
                            <p class="text-sm mt-1">${message}</p>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <button type="button" class="notification-close inline-flex text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md">
                                <i data-lucide="x" class="h-4 w-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(notification);
            
            // Add close functionality
            notification.querySelector('.notification-close').addEventListener('click', function() {
                notification.remove();
            });
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        } else {
            const titleEl = notification.querySelector('h4');
            const messageEl = notification.querySelector('p');
            if (titleEl) titleEl.textContent = title;
            if (messageEl) messageEl.textContent = message;
        }
        
        notification.classList.remove('hidden');
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
    
    // Modal system
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }
    
    // Close modals
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    });
    
    // Close notifications
    document.querySelectorAll('.notification-close').forEach(btn => {
        btn.addEventListener('click', function() {
            const notification = this.closest('.notification');
            if (notification) {
                notification.classList.add('hidden');
            }
        });
    });
    
    // Other action buttons
    document.querySelectorAll('button').forEach(button => {
        const text = button.textContent.trim();
        
        // Détails button
        if (text.includes('Détails')) {
            button.addEventListener('click', function() {
                const card = this.closest('.p-6');
                const teacherName = card.querySelector('h4').textContent;
                const roomInfo = card.querySelectorAll('dd')[0].textContent;
                const dateTime = card.querySelectorAll('dd')[1].textContent;
                const motif = card.querySelectorAll('dd')[2].textContent;
                const materiel = card.querySelectorAll('dd')[3].textContent;
                
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 z-50 overflow-y-auto';
                modal.innerHTML = `
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="this.parentElement.parentElement.remove()"></div>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Détails de la demande</h3>
                                <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                            <div class="space-y-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i data-lucide="user" class="h-6 w-6 text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">${teacherName}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Enseignant</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h5 class="font-medium text-gray-900 dark:text-white mb-2">Informations de réservation</h5>
                                        <div class="space-y-2 text-sm">
                                            <div><span class="font-medium text-gray-500">Salle:</span> ${roomInfo}</div>
                                            <div><span class="font-medium text-gray-500">Date & Heure:</span> ${dateTime}</div>
                                            <div><span class="font-medium text-gray-500">Motif:</span> ${motif}</div>
                                            <div><span class="font-medium text-gray-500">Matériel:</span> ${materiel}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-900 dark:text-white mb-2">Statut de validation</h5>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="check-circle" class="h-4 w-4 text-green-500"></i>
                                                <span>Salle disponible</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="check-circle" class="h-4 w-4 text-green-500"></i>
                                                <span>Matériel disponible</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <i data-lucide="check-circle" class="h-4 w-4 text-green-500"></i>
                                                <span>Aucun conflit détecté</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3 pt-4 border-t">
                                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Fermer
                                    </button>
                                    <button class="px-4 py-2 bg-green-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-green-700">
                                        <i data-lucide="check" class="h-4 w-4 mr-2 inline"></i>
                                        Approuver
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        }
        
        // Modifier button
        if (text.includes('Modifier')) {
            button.addEventListener('click', function() {
                const card = this.closest('.p-6');
                const teacherName = card.querySelector('h4').textContent;
                const roomInfo = card.querySelectorAll('dd')[0].textContent;
                
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 z-50 overflow-y-auto';
                modal.innerHTML = `
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="this.parentElement.parentElement.remove()"></div>
                        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Modifier la demande</h3>
                                <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Demande de ${teacherName} pour ${roomInfo}</p>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nouvelle salle proposée</label>
                                    <select class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option>Salle A201 (Amphithéâtre)</option>
                                        <option>Salle B105 (Salle de cours)</option>
                                        <option>Salle C301 (Laboratoire)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nouveau créneau</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="time" class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="14:00">
                                        <input type="time" class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="16:00">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message à l'enseignant</label>
                                    <textarea rows="3" class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Expliquez les modifications proposées..."></textarea>
                                </div>
                                <div class="flex justify-end space-x-3 pt-4">
                                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Annuler
                                    </button>
                                    <button onclick="this.closest('.fixed').remove(); showNotification('success', 'Modification envoyée', 'Les modifications ont été proposées à l\'enseignant.');" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700">
                                        <i data-lucide="send" class="h-4 w-4 mr-2 inline"></i>
                                        Envoyer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        }
        
        // Contacter button
        if (text.includes('Contacter')) {
            button.addEventListener('click', function() {
                const email = prompt('Envoyer un email à l\'enseignant ?\nAdresse:', 'enseignant@university.edu');
                if (email) {
                    showNotification('success', 'Email envoyé', `Message envoyé à ${email}`);
                }
            });
        }
        
        // Annuler/Supprimer button
        if (text.includes('Annuler') || text.includes('Supprimer')) {
            button.addEventListener('click', function() {
                if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
                    const card = this.closest('.p-6, tr');
                    if (card) {
                        card.style.opacity = '0.5';
                        this.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 mr-2 animate-spin"></i>Suppression...';
                        this.disabled = true;
                        
                        setTimeout(() => {
                            card.style.display = 'none';
                            showNotification('success', 'Réservation supprimée', 'La réservation a été supprimée avec succès.');
                        }, 1500);
                    }
                }
            });
        }
        
        // Nouvelle demande button
        if (text.includes('Nouvelle demande')) {
            button.addEventListener('click', function() {
                if (confirm('Créer une nouvelle demande basée sur cette réservation ?')) {
                    showNotification('info', 'Redirection', 'Redirection vers le formulaire...');
                    // window.location.href = '/reservations/create?copy=123';
                }
            });
        }
        
        // Confirmation/Download button
        if (text.includes('Confirmation')) {
            button.addEventListener('click', function() {
                showNotification('info', 'Téléchargement', 'Génération du PDF de confirmation...');
                // Simulate download
                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = 'data:text/plain;charset=utf-8,Confirmation de réservation - CampusConnect';
                    link.download = 'confirmation-reservation.txt';
                    link.click();
                }, 1000);
            });
        }
        
        // Réserver buttons (from availability page)
        if (text.includes('Réserver') && !text.includes('Nouvelle')) {
            button.addEventListener('click', function() {
                if (confirm('Rediriger vers le formulaire de réservation ?')) {
                    showNotification('info', 'Redirection', 'Redirection vers le formulaire...');
                    // window.location.href = '/reservations/create?room=A201';
                }
            });
        }
        
        // Filter buttons
        if (text.includes('Filtrer')) {
            button.addEventListener('click', function() {
                showNotification('info', 'Filtres appliqués', 'Les filtres ont été appliqués (simulation).');
                // Apply filters logic here
            });
        }
        
        // Tout approuver button
        if (text.includes('Tout approuver')) {
            button.addEventListener('click', function() {
                if (confirm('Approuver toutes les demandes en attente ?')) {
                    this.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 mr-2 animate-spin"></i>Traitement...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        showNotification('success', 'Toutes les demandes approuvées', '3 réservations ont été approuvées.');
                        this.innerHTML = '<i data-lucide="check-circle" class="h-4 w-4 mr-2"></i>Terminé';
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }, 2000);
                }
            });
        }
    });
});
</script>
@endpush