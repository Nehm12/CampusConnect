@extends('layouts.reservations')

@section('title', 'Mes réservations')

@section('header')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Mes réservations
            </h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Historique et statut de vos réservations
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('reservations.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                Nouvelle réservation
            </a>
        </div>
    </div>
@endsection

@section('content')
    {{-- Filters & Search --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="status-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Statut
                </label>
                <select id="status-filter"
                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvées</option>
                    <option value="rejected">Rejetées</option>
                </select>
            </div>

            <div>
                <label for="date-from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Du
                </label>
                <input type="date"
                       id="date-from"
                       class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>

            <div>
                <label for="date-to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Au
                </label>
                <input type="date"
                       id="date-to"
                       class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>

            <div class="flex items-end">
                <button type="button"
                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i data-lucide="search" class="h-4 w-4 mr-2"></i>
                    Filtrer
                </button>
            </div>
        </div>
    </div>

    {{-- Reservations List --}}
    <div class="space-y-6">
        {{-- Pending Reservation --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border-l-4 border-yellow-400">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                <i data-lucide="clock" class="h-5 w-5 text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Salle A201</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Amphithéâtre • 120 places</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        <i data-lucide="clock" class="h-4 w-4 mr-1"></i>
                        En attente
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">15 Novembre 2024</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Horaires</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">14:00 - 16:00</dd>
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

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Demandé le 10 Nov 2024 à 09:30
                    </div>
                    <div class="flex space-x-2">
                        <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i data-lucide="edit" class="h-4 w-4 mr-1"></i>
                            Modifier
                        </button>
                        <button class="inline-flex items-center px-3 py-1.5 border border-red-300 dark:border-red-600 shadow-sm text-sm font-medium rounded-md text-red-700 dark:text-red-300 bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i data-lucide="trash-2" class="h-4 w-4 mr-1"></i>
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>


        {{-- Approved Reservation --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border-l-4 border-green-400">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-600 dark:text-green-400"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Salle B105</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Salle de cours • 40 places</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        <i data-lucide="check-circle" class="h-4 w-4 mr-1"></i>
                        Approuvée
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">12 Novembre 2024</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Horaires</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">10:00 - 12:00</dd>
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

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Approuvée par <span class="font-medium">Admin Dupont</span> le 08 Nov 2024
                    </div>
                    <div class="flex space-x-2">
                        <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                            Détails
                        </button>
                        <button class="inline-flex items-center px-3 py-1.5 border border-blue-300 dark:border-blue-600 shadow-sm text-sm font-medium rounded-md text-blue-700 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i data-lucide="download" class="h-4 w-4 mr-1"></i>
                            Confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>


        {{-- Rejected Reservation --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border-l-4 border-red-400">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                                <i data-lucide="x-circle" class="h-5 w-5 text-red-600 dark:text-red-400"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Salle C301</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Laboratoire • 25 places</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        <i data-lucide="x-circle" class="h-4 w-4 mr-1"></i>
                        Rejetée
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">08 Novembre 2024</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Horaires</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">16:00 - 18:00</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motif</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">TP Informatique</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matériel</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">Ordinateurs</dd>
                    </div>
                </div>

                {{-- Rejection Reason --}}
                <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-red-800 dark:text-red-200">Motif du rejet</h4>
                            <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                                Conflit avec une autre réservation. La salle est déjà occupée par un cours de 15h à 19h.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Rejetée par <span class="font-medium">Admin Martin</span> le 05 Nov 2024
                    </div>
                    <div class="flex space-x-2">
                        <button class="inline-flex items-center px-3 py-1.5 border border-blue-300 dark:border-blue-600 shadow-sm text-sm font-medium rounded-md text-blue-700 dark:text-blue-300 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i data-lucide="repeat" class="h-4 w-4 mr-1"></i>
                            Nouvelle demande
                        </button>
                    </div>
                </div>
            </div>
        </div>


        {{-- Completed Reservation --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg border-l-4 border-gray-400 opacity-75">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <i data-lucide="check" class="h-5 w-5 text-gray-600 dark:text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Salle A201</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Amphithéâtre • 120 places</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                        <i data-lucide="check" class="h-4 w-4 mr-1"></i>
                        Terminée
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">05 Novembre 2024</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Horaires</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">09:00 - 11:00</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Motif</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">Conférence</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Matériel</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">Projecteur, Microphone</dd>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Réservation terminée avec succès
                    </div>
                    <div class="flex space-x-2">
                        <button class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                            Détails
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Pagination --}}
    <div class="mt-6 flex items-center justify-between">
        <div class="flex-1 flex justify-between sm:hidden">
            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                Précédent
            </button>
            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                Suivant
            </button>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Affichage de <span class="font-medium">1</span> à <span class="font-medium">4</span> sur <span class="font-medium">12</span> réservations
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i data-lucide="chevron-left" class="h-5 w-5"></i>
                    </button>
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        1
                    </button>
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-blue-50 dark:bg-blue-900 text-sm font-medium text-blue-600 dark:text-blue-400">
                        2
                    </button>
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        3
                    </button>
                    <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i data-lucide="chevron-right" class="h-5 w-5"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show notification helper
            function showNotification(type, title, message) {
                const notification = document.createElement('div');
                notification.style.cssText = 'position: fixed; top: 1rem; right: 1rem; z-index: 9999; background: white; border: 1px solid #ccc; border-radius: 0.5rem; padding: 1rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 20rem;';
                notification.innerHTML = `
                    <div style="display: flex; align-items: center;">
                        <div style="margin-right: 0.75rem;">
                            ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-weight: 500; margin: 0 0 0.25rem 0;">${title}</h4>
                            <p style="margin: 0; font-size: 0.875rem; color: #666;">${message}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" style="margin-left: 0.5rem; border: none; background: none; cursor: pointer; font-size: 1.25rem;">×</button>
                    </div>
                `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Attach event listeners to buttons
            document.querySelectorAll('button').forEach(button => {
                const text = button.textContent.trim();

                // Filter button
                if (text.includes('Filtrer')) {
                    button.addEventListener('click', function() {
                        showNotification('info', 'Filtres appliqués', 'Les filtres ont été appliqués avec succès.');
                    });
                }

                // Edit button
                if (text.includes('Modifier')) {
            button.addEventListener('click', function() {
                const modal = document.createElement('div');
                modal.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem;';
                modal.innerHTML = `
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);" onclick="this.parentElement.remove()"></div>
                    <div style="position: relative; background: white; border-radius: 0.5rem; padding: 1.5rem; max-width: 40rem; width: 100%; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); max-height: 90vh; overflow-y: auto;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 500; color: #111827; margin: 0;">Modifier la réservation</h3>
                            <button onclick="this.closest('[style*=fixed]').remove()" style="color: #9CA3AF; cursor: pointer; border: none; background: none; font-size: 1.5rem;">×</button>
                        </div>
                        <form style="margin-top: 1rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Salle</label>
                                    <input type="text" value="Salle A201" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; background: #F9FAFB;" readonly>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Type</label>
                                    <input type="text" value="Amphithéâtre" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; background: #F9FAFB;" readonly>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div>
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Date</label>
                                    <input type="date" value="2024-11-15" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Horaires</label>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                        <input type="time" value="14:00" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem;">
                                        <input type="time" value="16:00" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem;">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Motif</label>
                                <input type="text" value="Cours magistral" style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem;">
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Matériel requis</label>
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem;">
                                    <label style="display: flex; align-items: center; font-size: 0.875rem;"><input type="checkbox" checked style="margin-right: 0.5rem;"> Projecteur</label>
                                    <label style="display: flex; align-items: center; font-size: 0.875rem;"><input type="checkbox" checked style="margin-right: 0.5rem;"> Microphone</label>
                                    <label style="display: flex; align-items: center; font-size: 0.875rem;"><input type="checkbox" style="margin-right: 0.5rem;"> Ordinateurs</label>
                                    <label style="display: flex; align-items: center; font-size: 0.875rem;"><input type="checkbox" style="margin-right: 0.5rem;"> Tableau interactif</label>
                                </div>
                            </div>
                            <div style="margin-bottom: 1.5rem;">
                                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Commentaires</label>
                                <textarea rows="3" placeholder="Informations complémentaires..." style="width: 100%; padding: 0.5rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; resize: vertical;"></textarea>
                            </div>
                            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #E5E7EB;">
                                <button type="button" onclick="this.closest('[style*=fixed]').remove()" style="padding: 0.5rem 1rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; color: #374151; background: white; cursor: pointer;">Annuler</button>
                                <button type="submit" onclick="event.preventDefault(); showNotification('success', 'Réservation modifiée', 'Les modifications ont été enregistrées.'); this.closest('[style*=fixed]').remove();" style="padding: 0.5rem 1rem; background: #2563EB; border: none; border-radius: 0.375rem; font-size: 0.875rem; color: white; cursor: pointer;">Enregistrer</button>
                            </div>
                        </form>
                            </div>
                        `;
                        document.body.appendChild(modal);
                    });
                }

                // Cancel button
                if (text.includes('Annuler')) {
                    button.addEventListener('click', function() {
                        const card = this.closest('.bg-white');
                        if (!card) return;

                        if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
                            this.innerHTML = '⏳ Annulation...';
                            this.disabled = true;
                            setTimeout(() => {
                                showNotification('success', 'Réservation annulée', 'La réservation a été annulée.');
                            }, 1500);
                        }
                    });
                }

                // Details button
                if (text.includes('Détails')) {
            button.addEventListener('click', function() {
                const modal = document.createElement('div');
                modal.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem;';
                modal.innerHTML = `
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);" onclick="this.parentElement.remove()"></div>
                    <div style="position: relative; background: white; border-radius: 0.5rem; padding: 1.5rem; max-width: 32rem; width: 100%; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 500; color: #111827; margin: 0;">Détails de la réservation</h3>
                            <button onclick="this.closest('[style*=fixed]').remove()" style="color: #9CA3AF; cursor: pointer; border: none; background: none; font-size: 1.5rem;">×</button>
                        </div>
                        <div style="margin-top: 1rem;">
                            <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                <div style="width: 2.5rem; height: 2.5rem; background: #DBEAFE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem;">📍</div>
                                <div>
                                    <h4 style="font-weight: 500; color: #111827; margin: 0;">Salle B105</h4>
                                    <p style="font-size: 0.875rem; color: #6B7280; margin: 0;">Salle de cours • 40 places</p>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.875rem; margin-bottom: 1.5rem;">
                                <div><span style="font-weight: 500; color: #6B7280;">Date:</span><br><span style="color: #111827;">12 Novembre 2024</span></div>
                                <div><span style="font-weight: 500; color: #6B7280;">Horaires:</span><br><span style="color: #111827;">10:00 - 12:00</span></div>
                                <div><span style="font-weight: 500; color: #6B7280;">Motif:</span><br><span style="color: #111827;">Soutenance</span></div>
                                <div><span style="font-weight: 500; color: #6B7280;">Matériel:</span><br><span style="color: #111827;">Projecteur</span></div>
                            </div>
                            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; padding-top: 1rem; border-top: 1px solid #E5E7EB;">
                                <button onclick="this.closest('[style*=fixed]').remove()" style="padding: 0.5rem 1rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; color: #374151; background: white; cursor: pointer;">Fermer</button>
                                <button onclick="window.print()" style="padding: 0.5rem 1rem; background: #2563EB; border: none; border-radius: 0.375rem; font-size: 0.875rem; color: white; cursor: pointer;">🖨️ Imprimer</button>
                            </div>
                        </div>
                        </div>
                    `;
                        document.body.appendChild(modal);
                    });
                }

                // Confirmation button
                if (text.includes('Confirmation')) {
                    button.addEventListener('click', function() {
                        this.innerHTML = '⏳ Génération...';
                        this.disabled = true;

                        setTimeout(() => {
                            // Simulate PDF download
                            const link = document.createElement('a');
                            link.href = 'data:application/pdf;base64,JVBERi0xLjQKJcOkw7zDtsO4CjIgMCBvYmoKPDwKL0xlbmd0aCAzIDAgUgo+PgpzdHJlYW0KQNC0xLjQKJcOkw7zDtsO4CjIgMCBvYmoKPDwKL0xlbmd0aCAzIDAgUgo+PgpzdHJlYW0K';
                            link.download = 'confirmation-reservation-salle-b105.pdf';
                            link.click();

                            showNotification('success', 'PDF téléchargé', 'Le document de confirmation a été téléchargé.');

                            this.innerHTML = '<i data-lucide="download" class="h-4 w-4 mr-1"></i>Confirmation';
                            this.disabled = false;
                        }, 2000);
                    });
                }

                // New request button
                if (text.includes('Nouvelle demande')) {
                    button.addEventListener('click', function() {
                        if (confirm('Créer une nouvelle demande basée sur cette réservation ?')) {
                            showNotification('info', 'Redirection', 'Redirection vers le formulaire...');
                            setTimeout(() => {
                                window.location.href = '/reservations/create';
                            }, 1000);
                        }
                    });
                }
            });
        });
    </script>
@endpush