@extends('layouts.app')

@section('title', 'Mes Annonces - Enseignant')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">📢 Mes Annonces</h1>
                    <p class="mt-2 text-gray-600">Gérez vos annonces publiées pour les étudiants</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button 
                        onclick="document.getElementById('createAnnouncementModal').classList.remove('hidden')"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Créer une annonce
                    </button>
                </div>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Mes Annonces</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['my_announcements'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Cette Semaine</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['week_announcements'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Vues Totales</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_views'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg">
                        <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Engagement</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['avg_engagement'] ?? 0 }}%</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mes annonces --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-blue-100 rounded-t-xl">
                <h2 class="text-xl font-bold text-blue-900">Toutes mes annonces</h2>
            </div>
            
            <div class="p-6">
                @forelse($announcements ?? [] as $announcement)
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-4 hover:shadow-md transition-all duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                {{-- ✅ En-tête avec auteur --}}
                                <div class="flex items-center space-x-3 mb-3">
                                    {{-- Avatar et nom de l'auteur --}}
                                    <div class="flex items-center space-x-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($announcement->user->firstname ?? 'A', 0, 1)) }}{{ strtoupper(substr($announcement->user->lastname ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $announcement->user->firstname ?? 'Auteur' }} {{ $announcement->user->lastname ?? 'Inconnu' }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    {{-- Badges --}}
                                    @if($announcement->category)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            {{ $announcement->category->name }}
                                        </span>
                                    @endif
                                    
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                        🔒 Non modifiable
                                    </span>
                                </div>

                                {{-- Titre --}}
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $announcement->title }}</h3>
                                
                                {{-- Description --}}
                                <p class="text-gray-600 mb-4">{{ Str::limit($announcement->description, 150) }}</p>
                                
                                {{-- Métadonnées --}}
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $announcement->created_at->format('d/m/Y à H:i') }}
                                    </span>

                                    {{-- Bouton voir détails --}}
                                    <button 
                                        onclick="showAnnouncementDetails({{ $announcement->id }})"
                                        class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Voir les détails
                                    </button>
                                </div>
                            </div>
                            
                            {{-- Badge "Publié" --}}
                            <div class="ml-6">
                                <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-semibold flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Publié</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune annonce</h3>
                        <p class="text-gray-500 mb-6">Vous n'avez pas encore publié d'annonces</p>
                        <button 
                            onclick="document.getElementById('createAnnouncementModal').classList.remove('hidden')"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Créer ma première annonce
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal de création d'annonce --}}
<div id="createAnnouncementModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-2xl font-bold text-gray-900">📢 Créer une nouvelle annonce</h3>
                <button 
                    onclick="document.getElementById('createAnnouncementModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            {{-- Message d'avertissement --}}
            <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>⚠️ Attention :</strong> Une fois publiée, l'annonce ne pourra <strong>plus être modifiée ni supprimée</strong>. Vérifiez bien le contenu avant de publier.
                        </p>
                    </div>
                </div>
            </div>
            
            <form id="createAnnouncementForm" action="{{ route('enseignant.announcements.store') }}" method="POST" class="mt-6">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce *</label>
                        <input type="text" id="title" name="title" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Ex: Nouvel horaire des cours...">
                    </div>
                    
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                        <select id="category_id" name="category_id" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionner une catégorie (optionnel)</option>
                            @forelse($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="">Aucune catégorie disponible</option>
                            @endforelse
                        </select>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description de l'annonce *</label>
                        <textarea id="description" name="description" rows="6" required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="Rédigez le contenu de votre annonce ici..."></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <button type="button" 
                            onclick="document.getElementById('createAnnouncementModal').classList.add('hidden')"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        📢 Publier définitivement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ✅ Modal de détails d'annonce --}}
<div id="announcementDetailsModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-2xl rounded-xl bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-2xl font-bold text-gray-900">📄 Détails de l'annonce</h3>
                <button 
                    onclick="closeAnnouncementDetails()"
                    class="text-gray-400 hover:text-gray-600 text-3xl font-bold">
                    &times;
                </button>
            </div>
            
            <div id="announcementDetailsContent" class="mt-6">
                <!-- Le contenu sera injecté dynamiquement par JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
// Fermer le modal en cliquant à l'extérieur
window.onclick = function(event) {
    const createModal = document.getElementById('createAnnouncementModal');
    const detailsModal = document.getElementById('announcementDetailsModal');
    if (event.target === createModal) {
        createModal.classList.add('hidden');
    }
    if (event.target === detailsModal) {
        detailsModal.classList.add('hidden');
    }
}

// ✅ Afficher les détails d'une annonce
function showAnnouncementDetails(announcementId) {
    const announcements = @json($announcements ?? []);
    const announcement = announcements.find(a => a.id === announcementId);
    
    if (!announcement) {
        alert('Annonce introuvable');
        return;
    }

    const content = `
        <div class="space-y-6">
            <!-- En-tête avec auteur -->
            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                    ${announcement.user.firstname.charAt(0).toUpperCase()}${announcement.user.lastname.charAt(0).toUpperCase()}
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-900">${announcement.user.firstname} ${announcement.user.lastname}</p>
                    <p class="text-sm text-gray-600">Publié ${new Date(announcement.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</p>
                </div>
                ${announcement.category ? `<span class="ml-auto px-3 py-1 text-sm rounded-full bg-green-100 text-green-700 font-medium">${announcement.category.name}</span>` : ''}
            </div>

            <!-- Titre -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">${announcement.title}</h2>
            </div>

            <!-- Description complète -->
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">${announcement.description}</p>
            </div>

            <!-- Métadonnées -->
            <div class="border-t pt-4 mt-6">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                        <span>Créé le: ${new Date(announcement.created_at).toLocaleDateString('fr-FR')}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Statut: Publié</span>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('announcementDetailsContent').innerHTML = content;
    document.getElementById('announcementDetailsModal').classList.remove('hidden');
}

function closeAnnouncementDetails() {
    document.getElementById('announcementDetailsModal').classList.add('hidden');
}
</script>
@endsection