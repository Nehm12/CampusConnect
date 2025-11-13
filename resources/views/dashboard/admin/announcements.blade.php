@extends('layouts.app')

@section('title', 'Gestion des annonces')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
        
        {{-- Header Responsive --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8 space-y-4 sm:space-y-0">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 flex items-center">
                    <span class="text-3xl sm:text-4xl mr-2 sm:mr-3">📢</span>
                    <span class="hidden sm:inline">Gestion des Annonces</span>
                    <span class="sm:hidden">Annonces</span>
                </h1>
                <p class="mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base text-gray-600">Publiez et gérez les annonces de la plateforme</p>
            </div>
            <button 
                onclick="openModal('addAnnouncementModal')" 
                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-3 rounded-xl font-semibold flex items-center justify-center space-x-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-sm sm:text-base">Nouvelle annonce</span>
            </button>
        </div>

        {{-- Messages de succès/erreur --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-fadeIn">
                <div class="flex items-start">
                    <span class="text-xl sm:text-2xl mr-2 sm:mr-3 flex-shrink-0">✅</span>
                    <p class="text-green-800 font-semibold text-xs sm:text-sm lg:text-base">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-fadeIn">
                <div class="flex items-start">
                    <span class="text-xl sm:text-2xl mr-2 sm:mr-3 flex-shrink-0">❌</span>
                    <p class="text-red-800 font-semibold text-xs sm:text-sm lg:text-base">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        {{-- Barre de recherche --}}
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6 sm:mb-8 border border-gray-200">
            <form method="GET" action="{{ route('admin.announcements') }}" class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">🔍 Rechercher</label>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Titre de l'annonce..." 
                            class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        >
                    </div>

                    <div class="flex items-end space-x-2">
                        <button 
                            type="submit" 
                            class="flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all shadow-md hover:shadow-lg"
                        >
                            Filtrer
                        </button>
                        <a 
                            href="{{ route('admin.announcements') }}" 
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 sm:px-6 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all"
                        >
                            <span class="hidden sm:inline">Réinitialiser</span>
                            <span class="sm:hidden">🔄</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Liste des annonces --}}
        <div class="space-y-4">
            @forelse($announcements as $announcement)
                <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200 hover:shadow-xl transition-all duration-200 {{ $announcement->is_pinned ? 'border-l-4 border-l-yellow-400' : '' }}">
                    {{-- En-tête --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-start space-x-3 flex-1">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ strtoupper(substr($announcement->user->firstname, 0, 1)) }}{{ strtoupper(substr($announcement->user->lastname, 0, 1)) }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900">
                                        {{ $announcement->title }}
                                    </h3>
                                    @if($announcement->is_pinned)
                                        <span class="text-yellow-500 text-lg" title="Annonce épinglée">📌</span>
                                    @endif
                                </div>
                                <div class="flex flex-wrap items-center gap-2 mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-semibold rounded-full {{ $announcement->category->color ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $announcement->category->name ?? 'Sans catégorie' }}
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-xs sm:text-sm text-gray-600">
                                        Par <span class="font-semibold">{{ $announcement->user->firstname }} {{ $announcement->user->lastname }}</span>
                                    </span>
                                    <span class="text-gray-400">•</span>
                                    <span class="text-xs sm:text-sm text-gray-500">
                                        {{ $announcement->published_at ? $announcement->published_at->diffForHumans() : $announcement->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Actions desktop --}}
                        <div class="hidden sm:flex items-center space-x-2 ml-4">
                            <button 
                                onclick="openEditModal(
                                    {{ $announcement->id }}, 
                                    '{{ addslashes($announcement->title) }}', 
                                    '{{ addslashes($announcement->description) }}',
                                    {{ $announcement->category_id ?? 'null' }},
                                    '{{ $announcement->published_at ? $announcement->published_at->format('Y-m-d\TH:i') : '' }}',
                                    {{ $announcement->is_pinned ? 1 : 0 }}
                                )" 
                                class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-sm font-semibold transition-all"
                            >
                                ✏️ Modifier
                            </button>
                            <form 
                                action="{{ route('admin.announcements.destroy', $announcement->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Supprimer cette annonce ?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg text-sm font-semibold transition-all"
                                >
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose prose-sm sm:prose max-w-none">
                        <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                            {{ $announcement->description }}
                        </p>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-3 py-1 text-xs sm:text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                📅 {{ $announcement->published_at ? $announcement->published_at->format('d/m/Y à H:i') : $announcement->created_at->format('d/m/Y à H:i') }}
                            </span>

                            {{-- Actions mobile --}}
                            <div class="flex sm:hidden items-center space-x-2">
                                <button 
                                    onclick="openEditModal(
                                        {{ $announcement->id }}, 
                                        '{{ addslashes($announcement->title) }}', 
                                        '{{ addslashes($announcement->description) }}',
                                        {{ $announcement->category_id ?? 'null' }},
                                        '{{ $announcement->published_at ? $announcement->published_at->format('Y-m-d\TH:i') : '' }}',
                                        {{ $announcement->is_pinned ? 1 : 0 }}
                                    )" 
                                    class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                                >
                                    ✏️
                                </button>
                                <form 
                                    action="{{ route('admin.announcements.destroy', $announcement->id) }}" 
                                    method="POST" 
                                    onsubmit="return confirm('Supprimer ?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                                    >
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-lg p-8 sm:p-12 text-center border border-gray-200">
                    <div class="text-6xl sm:text-8xl mb-4">📢</div>
                    <p class="text-gray-500 text-sm sm:text-base">Aucune annonce trouvée</p>
                    <button 
                        onclick="openModal('addAnnouncementModal')" 
                        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-all"
                    >
                        Publier la première annonce
                    </button>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</div>

{{-- ========== MODAL AJOUT ========== --}}
<div id="addAnnouncementModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white flex items-center justify-between p-4 sm:p-6 border-b border-gray-200 z-10">
            <h3 class="text-lg sm:text-xl font-bold text-gray-900">📢 Nouvelle annonce</h3>
            <button onclick="closeModal('addAnnouncementModal')" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.announcements.store') }}" class="p-4 sm:p-6">
            @csrf
            <div class="space-y-4">
                {{-- Titre --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📝 Titre *</label>
                    <input 
                        type="text" 
                        name="title" 
                        required 
                        maxlength="255"
                        placeholder="Ex: Nouvelle salle de cours disponible"
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                </div>

                {{-- Catégorie --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📁 Catégorie *</label>
                    <select 
                        name="category_id" 
                        required
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                        <option value="">-- Sélectionner une catégorie --</option>
                        @foreach(\App\Models\AnnouncementCategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📄 Description *</label>
                    <textarea 
                        name="description" 
                        required 
                        rows="6"
                        placeholder="Décrivez votre annonce en détail..."
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all"
                    ></textarea>
                </div>

                {{-- Date de publication --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Date de publication</label>
                    <input 
                        type="datetime-local" 
                        name="published_at" 
                        value="{{ now()->format('Y-m-d\TH:i') }}"
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                    <p class="text-xs text-gray-500 mt-1.5">Programmez la publication ou laissez pour publier maintenant</p>
                </div>

                {{-- Épingler --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="is_pinned" 
                            id="is_pinned_add"
                            value="1"
                            class="w-4 h-4 mt-0.5 text-yellow-600 border-yellow-300 rounded focus:ring-yellow-500"
                        >
                        <div class="ml-3">
                            <label for="is_pinned_add" class="text-sm font-semibold text-yellow-900 cursor-pointer">
                                📌 Épingler cette annonce
                            </label>
                            <p class="text-xs text-yellow-700 mt-1">L'annonce sera affichée en priorité en haut de la liste</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="closeModal('addAnnouncementModal')" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 sm:px-6 py-2.5 rounded-lg text-sm font-semibold transition-all"
                >
                    Annuler
                </button>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-2.5 rounded-lg text-sm font-semibold shadow-lg hover:shadow-xl transition-all"
                >
                    Publier l'annonce
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL MODIFICATION ========== --}}
<div id="editAnnouncementModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white flex items-center justify-between p-4 sm:p-6 border-b border-gray-200 z-10">
            <h3 class="text-lg sm:text-xl font-bold text-gray-900">✏️ Modifier l'annonce</h3>
            <button onclick="closeModal('editAnnouncementModal')" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
        </div>
        <form id="editAnnouncementForm" method="POST" class="p-4 sm:p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                {{-- Titre --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📝 Titre *</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="edit_title" 
                        required 
                        maxlength="255"
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                </div>

                {{-- Catégorie --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📁 Catégorie *</label>
                    <select 
                        name="category_id" 
                        id="edit_category_id"
                        required
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                        <option value="">-- Sélectionner une catégorie --</option>
                        @foreach(\App\Models\AnnouncementCategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📄 Description *</label>
                    <textarea 
                        name="description" 
                        id="edit_description" 
                        required 
                        rows="6"
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-all"
                    ></textarea>
                </div>

                {{-- Date de publication --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">📅 Date de publication</label>
                    <input 
                        type="datetime-local" 
                        name="published_at" 
                        id="edit_published_at"
                        class="w-full px-3 sm:px-4 py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    >
                </div>

                {{-- Épingler --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="is_pinned" 
                            id="edit_is_pinned"
                            value="1"
                            class="w-4 h-4 mt-0.5 text-yellow-600 border-yellow-300 rounded focus:ring-yellow-500"
                        >
                        <div class="ml-3">
                            <label for="edit_is_pinned" class="text-sm font-semibold text-yellow-900 cursor-pointer">
                                📌 Épingler cette annonce
                            </label>
                            <p class="text-xs text-yellow-700 mt-1">L'annonce sera affichée en priorité</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="closeModal('editAnnouncementModal')" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 sm:px-6 py-2.5 rounded-lg text-sm font-semibold transition-all"
                >
                    Annuler
                </button>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-2.5 rounded-lg text-sm font-semibold shadow-lg hover:shadow-xl transition-all"
                >
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(id, title, description, categoryId, publishedAt, isPinned) {
        document.getElementById('editAnnouncementForm').action = `/admin/announcements/${id}`;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_category_id').value = categoryId || '';
        document.getElementById('edit_published_at').value = publishedAt || '';
        document.getElementById('edit_is_pinned').checked = isPinned == 1;
        openModal('editAnnouncementModal');
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('bg-opacity-50')) {
            closeModal('addAnnouncementModal');
            closeModal('editAnnouncementModal');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal('addAnnouncementModal');
            closeModal('editAnnouncementModal');
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>
@endsection