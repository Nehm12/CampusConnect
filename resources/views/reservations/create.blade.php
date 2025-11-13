@extends('layouts.reservations')

@section('title', 'Nouvelle réservation')

@section('header')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nouvelle réservation</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Réservez une salle et du matériel pour vos cours ou activités
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('reservations.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
                Retour
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Progress Steps --}}
        <div class="mb-8">
        <nav aria-label="Progress">
            <ol role="list" class="flex items-center justify-center">
                <li class="relative pr-8 sm:pr-20">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-blue-600"></div>
                    </div>
                    <div class="relative flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 text-white">
                        <span class="text-sm font-medium">1</span>
                    </div>
                    <span class="absolute top-10 left-1/2 transform -translate-x-1/2 text-xs font-medium text-blue-600">Salle</span>
                </li>
                <li class="relative pr-8 sm:pr-20">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="h-0.5 w-full bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <div class="relative flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                        <span class="text-sm font-medium">2</span>
                    </div>
                    <span class="absolute top-10 left-1/2 transform -translate-x-1/2 text-xs font-medium text-gray-500">Horaires</span>
                </li>
                <li class="relative">
                    <div class="relative flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                        <span class="text-sm font-medium">3</span>
                    </div>
                    <span class="absolute top-10 left-1/2 transform -translate-x-1/2 text-xs font-medium text-gray-500">Matériel</span>
                </li>
            </ol>
        </nav>
    </div>

        {{-- Main Form --}}
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <form class="space-y-8 p-6 sm:p-8">
                {{-- Step 1: Salle Selection --}}
                <div class="space-y-6">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-blue-600"></i>
                        Sélection de la salle
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Choisissez la salle que vous souhaitez réserver
                    </p>
                </div>

                    {{-- Room Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Room Card Template --}}
                    <div class="room-card relative rounded-lg border-2 border-gray-200 dark:border-gray-700 p-4 cursor-pointer hover:border-blue-500 dark:hover:border-blue-400 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                         tabindex="0" 
                         data-room="A201">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle A201</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Amphithéâtre</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i data-lucide="users" class="h-4 w-4 mr-1"></i>
                                    <span>120 places</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="h-4 w-4 rounded-full border-2 border-gray-300 dark:border-gray-600 room-checkbox"></div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                                Disponible
                            </span>
                        </div>
                    </div>

                    <div class="room-card relative rounded-lg border-2 border-gray-200 dark:border-gray-700 p-4 cursor-pointer hover:border-blue-500 dark:hover:border-blue-400 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                         tabindex="0" 
                         data-room="B105">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle B105</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Salle de cours</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i data-lucide="users" class="h-4 w-4 mr-1"></i>
                                    <span>40 places</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="h-4 w-4 rounded-full border-2 border-gray-300 dark:border-gray-600 room-checkbox"></div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                                Disponible
                            </span>
                        </div>
                    </div>

                    <div class="room-card relative rounded-lg border-2 border-gray-200 dark:border-gray-700 p-4 opacity-60 cursor-not-allowed" 
                         data-room="C301">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle C301</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Laboratoire</p>
                                <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i data-lucide="users" class="h-4 w-4 mr-1"></i>
                                    <span>25 places</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="h-4 w-4 rounded-full border-2 border-gray-300 dark:border-gray-600"></div>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                <i data-lucide="x-circle" class="h-3 w-3 mr-1"></i>
                                Occupée
                            </span>
                        </div>
                    </div>
                </div>
            </div>

                {{-- Step 2: Date & Time --}}
                <div class="space-y-6">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="calendar" class="h-5 w-5 mr-2 text-blue-600"></i>
                        Date et horaires
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Définissez la période de votre réservation
                    </p>
                </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Date Selection --}}
                        <div>
                        <label for="reservation-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date de réservation
                        </label>
                        <input type="date" 
                               id="reservation-date" 
                               name="reservation_date"
                               class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               min="{{ date('Y-m-d') }}">
                    </div>

                        {{-- Time Selection --}}
                        <div class="space-y-4">
                        <div>
                            <label for="start-time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Heure de début
                            </label>
                            <input type="time" 
                                   id="start-time" 
                                   name="start_time"
                                   class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end-time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Heure de fin
                            </label>
                            <input type="time" 
                                   id="end-time" 
                                   name="end_time"
                                   class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

                {{-- Step 3: Equipment --}}
                <div class="space-y-6">
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="monitor" class="h-5 w-5 mr-2 text-blue-600"></i>
                        Matériel (optionnel)
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Sélectionnez le matériel dont vous avez besoin
                    </p>
                </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Equipment Items --}}
                        <div class="equipment-item flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <input type="checkbox" 
                               id="projector" 
                               name="equipment[]" 
                               value="projector"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                        <label for="projector" class="ml-3 flex-1">
                            <div class="flex items-center">
                                <i data-lucide="projector" class="h-5 w-5 mr-2 text-gray-500"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Projecteur</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">5 disponibles</p>
                        </label>
                    </div>

                    <div class="equipment-item flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <input type="checkbox" 
                               id="microphone" 
                               name="equipment[]" 
                               value="microphone"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                        <label for="microphone" class="ml-3 flex-1">
                            <div class="flex items-center">
                                <i data-lucide="mic" class="h-5 w-5 mr-2 text-gray-500"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Microphone</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">8 disponibles</p>
                        </label>
                    </div>

                    <div class="equipment-item flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <input type="checkbox" 
                               id="laptop" 
                               name="equipment[]" 
                               value="laptop"
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                        <label for="laptop" class="ml-3 flex-1">
                            <div class="flex items-center">
                                <i data-lucide="laptop" class="h-5 w-5 mr-2 text-gray-500"></i>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Ordinateur portable</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">3 disponibles</p>
                        </label>
                    </div>
                </div>
            </div>

                {{-- Motif --}}
                <div class="space-y-6">
                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Motif de la réservation
                    </label>
                    <select id="purpose" 
                            name="purpose"
                            class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Sélectionnez un motif</option>
                        <option value="cours">Cours</option>
                        <option value="soutenance">Soutenance</option>
                        <option value="reunion">Réunion</option>
                        <option value="conference">Conférence</option>
                        <option value="examen">Examen</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Description (optionnel)
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              placeholder="Ajoutez des détails sur votre réservation..."
                              class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                </div>
            </div>

                {{-- Form Actions --}}
                <div class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="button" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Annuler
                </button>
                <button type="submit" 
                        class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i data-lucide="send" class="h-4 w-4 mr-2"></i>
                    Soumettre la demande
                </button>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Room selection logic
    const roomCards = document.querySelectorAll('.room-card');
    let selectedRoom = null;

    roomCards.forEach(card => {
        if (!card.classList.contains('cursor-not-allowed')) {
            card.addEventListener('click', function() {
                // Remove previous selection
                if (selectedRoom) {
                    selectedRoom.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
                    selectedRoom.querySelector('.room-checkbox').classList.remove('bg-blue-600', 'border-blue-600');
                    selectedRoom.querySelector('.room-checkbox').innerHTML = '';
                }

                // Add new selection
                this.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
                const checkbox = this.querySelector('.room-checkbox');
                checkbox.classList.add('bg-blue-600', 'border-blue-600');
                checkbox.innerHTML = '<i data-lucide="check" class="h-3 w-3 text-white"></i>';
                
                selectedRoom = this;
                
                // Reinitialize icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        }
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!selectedRoom) {
            alert('Veuillez sélectionner une salle');
            return;
        }

        const date = document.getElementById('reservation-date').value;
        const startTime = document.getElementById('start-time').value;
        const endTime = document.getElementById('end-time').value;
        const purpose = document.getElementById('purpose').value;

        if (!date || !startTime || !endTime || !purpose) {
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }

        if (startTime >= endTime) {
            alert('L\'heure de fin doit être postérieure à l\'heure de début');
            return;
        }

        // Simulate form submission
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i data-lucide="loader-2" class="h-4 w-4 mr-2 animate-spin"></i>Envoi en cours...';
        submitBtn.disabled = true;

        setTimeout(() => {
            alert('Demande de réservation envoyée avec succès !');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }, 2000);
        });
        });
    </script>
@endpush