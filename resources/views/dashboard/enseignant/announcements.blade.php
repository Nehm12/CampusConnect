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
                                <div class="flex items-center space-x-3 mb-3">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                        📢 Ma Publication
                                    </span>
                                    <span class="text-gray-500 text-sm">{{ $announcement->created_at->diffForHumans() }}</span>
                                    @if($announcement->category)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            {{ $announcement->category->name }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $announcement->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($announcement->content, 150) }}</p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ $announcement->views ?? 0 }} vues
                                    </div>
                                    <span>•</span>
                                    <span>{{ $announcement->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2 ml-4">
                                <button 
                                    onclick="editAnnouncement({{ $announcement->id }}, '{{ $announcement->title }}', `{{ $announcement->content }}`, {{ $announcement->category_id ?? 'null' }})"
                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium px-3 py-1 rounded hover:bg-blue-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Modifier
                                </button>
                                <button 
                                    onclick="deleteAnnouncement({{ $announcement->id }}, '{{ $announcement->title }}')"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium px-3 py-1 rounded hover:bg-red-50 transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
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
            
            <form id="createAnnouncementForm" action="{{ route('enseignant.announcements.store') }}" method="POST" class="mt-6">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce</label>
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
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu de l'annonce</label>
                        <textarea id="content" name="content" rows="6" required 
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
                        📢 Publier l'annonce
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal d'édition d'annonce --}}
<div id="editAnnouncementModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-2xl font-bold text-gray-900">✏️ Modifier l'annonce</h3>
                <button 
                    onclick="document.getElementById('editAnnouncementModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="editAnnouncementForm" method="POST" class="mt-6">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce</label>
                        <input type="text" id="edit_title" name="title" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="edit_category_id" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                        <select id="edit_category_id" name="category_id" 
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
                        <label for="edit_content" class="block text-sm font-medium text-gray-700 mb-2">Contenu de l'annonce</label>
                        <textarea id="edit_content" name="content" rows="6" required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <button type="button" 
                            onclick="document.getElementById('editAnnouncementModal').classList.add('hidden')"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        💾 Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editAnnouncement(id, title, content, categoryId) {
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_content').value = content;
    document.getElementById('edit_category_id').value = categoryId || '';
    document.getElementById('editAnnouncementForm').action = `/enseignant/announcements/${id}`;
    document.getElementById('editAnnouncementModal').classList.remove('hidden');
}

function deleteAnnouncement(id, title) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'annonce "${title}" ?\n\nCette action est irréversible.`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/enseignant/announcements/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Fermer les modals en cliquant à l'extérieur
window.onclick = function(event) {
    const createModal = document.getElementById('createAnnouncementModal');
    const editModal = document.getElementById('editAnnouncementModal');
    
    if (event.target === createModal) {
        createModal.classList.add('hidden');
    }
    if (event.target === editModal) {
        editModal.classList.add('hidden');
    }
}
</script>
@endsection