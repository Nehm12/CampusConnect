@extends('layouts.reservations')

@section('title', 'Disponibilités')

@section('header')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Disponibilités</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Consultez les salles et matériels disponibles
        </p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('reservations.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
            Réserver
        </a>
    </div>
</div>
@endsection

@section('content')
<!-- Filters -->
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="date-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Date
            </label>
            <input type="date" 
                   id="date-filter" 
                   class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                   value="{{ date('Y-m-d') }}">
        </div>
        <div>
            <label for="time-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Heure de début
            </label>
            <input type="time" 
                   id="time-filter" 
                   class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                   value="08:00">
        </div>
        <div>
            <label for="duration-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Durée (heures)
            </label>
            <select id="duration-filter" 
                    class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value="1">1 heure</option>
                <option value="2" selected>2 heures</option>
                <option value="3">3 heures</option>
                <option value="4">4 heures</option>
            </select>
        </div>
    </div>
</div>

<!-- Availability Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Salles disponibles -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                <i data-lucide="map-pin" class="h-5 w-5 mr-2 text-green-600"></i>
                Salles disponibles
            </h3>
        </div>
        <div class="p-6 space-y-4">
            <!-- Room Card -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-green-300 dark:hover:border-green-600 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle A201</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Amphithéâtre • 120 places</p>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i data-lucide="projector" class="h-4 w-4 mr-1"></i>
                                Projecteur
                            </span>
                            <span class="flex items-center">
                                <i data-lucide="mic" class="h-4 w-4 mr-1"></i>
                                Micro
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                            Libre
                        </span>
                        <button class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                            Réserver
                        </button>
                    </div>
                </div>
            </div>

            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-green-300 dark:hover:border-green-600 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle B105</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Salle de cours • 40 places</p>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i data-lucide="monitor" class="h-4 w-4 mr-1"></i>
                                Écran
                            </span>
                            <span class="flex items-center">
                                <i data-lucide="wifi" class="h-4 w-4 mr-1"></i>
                                WiFi
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            <i data-lucide="check-circle" class="h-3 w-3 mr-1"></i>
                            Libre
                        </span>
                        <button class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                            Réserver
                        </button>
                    </div>
                </div>
            </div>

            <!-- Occupied Room -->
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 opacity-60">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Salle C301</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Laboratoire • 25 places</p>
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Occupée jusqu'à 16:00
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            <i data-lucide="x-circle" class="h-3 w-3 mr-1"></i>
                            Occupée
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Matériel disponible -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                <i data-lucide="monitor" class="h-5 w-5 mr-2 text-blue-600"></i>
                Matériel disponible
            </h3>
        </div>
        <div class="p-6 space-y-4">
            <!-- Equipment Items -->
            <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-3">
                        <i data-lucide="projector" class="h-5 w-5 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">Projecteurs</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">HD, 4K disponibles</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold text-green-600 dark:text-green-400">5</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">disponibles</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-3">
                        <i data-lucide="mic" class="h-5 w-5 text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">Microphones</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sans fil, filaires</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold text-green-600 dark:text-green-400">8</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">disponibles</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-3">
                        <i data-lucide="laptop" class="h-5 w-5 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">Ordinateurs portables</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Windows, MacBook</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold text-green-600 dark:text-green-400">3</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">disponibles</div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg opacity-60">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mr-3">
                        <i data-lucide="camera" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">Caméras</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Toutes réservées</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-semibold text-red-600 dark:text-red-400">0</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">disponibles</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Planning Timeline -->
<div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
            <i data-lucide="calendar" class="h-5 w-5 mr-2 text-purple-600"></i>
            Planning du jour
        </h3>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <div class="min-w-full">
                <!-- Timeline Header -->
                <div class="grid grid-cols-13 gap-1 mb-4">
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">Salle</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">8h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">9h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">10h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">11h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">12h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">13h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">14h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">15h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">16h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">17h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">18h</div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 text-center">19h</div>
                </div>
                
                <!-- Timeline Rows -->
                <div class="space-y-2">
                    <!-- A201 -->
                    <div class="grid grid-cols-13 gap-1 items-center">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">A201</div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-red-100 dark:bg-red-900 rounded border-2 border-red-300 dark:border-red-700"></div>
                        <div class="h-8 bg-red-100 dark:bg-red-900 rounded border-2 border-red-300 dark:border-red-700"></div>
                        <div class="h-8 bg-gray-100 dark:bg-gray-700 rounded border-2 border-gray-300 dark:border-gray-600"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                    </div>
                    
                    <!-- B105 -->
                    <div class="grid grid-cols-13 gap-1 items-center">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">B105</div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-gray-100 dark:bg-gray-700 rounded border-2 border-gray-300 dark:border-gray-600"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                        <div class="h-8 bg-green-100 dark:bg-green-900 rounded border-2 border-green-300 dark:border-green-700"></div>
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="mt-4 flex items-center space-x-6 text-sm">
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-green-100 dark:bg-green-900 border-2 border-green-300 dark:border-green-700 rounded mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Disponible</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-red-100 dark:bg-red-900 border-2 border-red-300 dark:border-red-700 rounded mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Occupé</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-4 h-4 bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Pause</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function showNotification(type, title, message) {
        const notification = document.createElement('div');
        notification.className = 'notification fixed top-4 right-4 z-50 transform transition-all duration-300 ease-in-out';
        notification.innerHTML = `
            <div class="max-w-sm w-full bg-${type === 'success' ? 'green' : 'blue'}-50 border border-${type === 'success' ? 'green' : 'blue'}-200 text-${type === 'success' ? 'green' : 'blue'}-800 rounded-lg shadow-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i data-lucide="${type === 'success' ? 'check-circle' : 'info'}" class="h-5 w-5 text-${type === 'success' ? 'green' : 'blue'}-400"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-sm font-medium">${title}</h4>
                        <p class="text-sm mt-1">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <button type="button" class="notification-close inline-flex text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i data-lucide="x" class="h-4 w-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(notification);
        
        notification.querySelector('.notification-close').addEventListener('click', function() {
            notification.remove();
        });
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
    
    // Filter functionality
    const dateFilter = document.getElementById('date-filter');
    const timeFilter = document.getElementById('time-filter');
    const durationFilter = document.getElementById('duration-filter');
    
    [dateFilter, timeFilter, durationFilter].forEach(filter => {
        if (filter) {
            filter.addEventListener('change', function() {
                showNotification('info', 'Filtres mis à jour', 'Les disponibilités ont été mises à jour.');
            });
        }
    });
    
    // Reserve buttons
    document.querySelectorAll('button').forEach(button => {
        const text = button.textContent.trim();
        
        if (text.includes('Réserver') && !text.includes('Nouvelle')) {
            button.addEventListener('click', function() {
                const roomCard = this.closest('.border');
                const roomName = roomCard ? roomCard.querySelector('h4').textContent : 'cette salle';
                
                if (confirm(`Voulez-vous réserver ${roomName} ?`)) {
                    showNotification('success', 'Redirection', `Redirection vers le formulaire pour ${roomName}...`);
                }
            });
        }
    });
});
</script>
@endpush