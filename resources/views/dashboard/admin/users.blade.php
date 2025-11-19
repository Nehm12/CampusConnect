@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
        
        {{-- Header Responsive --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8 space-y-4 sm:space-y-0">
            <div class="flex-1">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 flex items-center">
                    <span class="text-3xl sm:text-4xl mr-2 sm:mr-3">👥</span>
                    <span class="hidden sm:inline">Gestion des Utilisateurs</span>
                    <span class="sm:hidden">Utilisateurs</span>
                </h1>
                <p class="mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base text-gray-600">Gérez tous les comptes de la plateforme</p>
            </div>
            <button 
                onclick="openModal('addUserModal')" 
                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 sm:px-6 py-3 rounded-xl font-semibold flex items-center justify-center space-x-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-sm sm:text-base">Nouvel utilisateur</span>
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

        {{-- Filtres --}}
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6 sm:mb-8 border border-gray-200">
            <form method="GET" action="{{ route('admin.users.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Recherche --}}
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">🔍 Rechercher</label>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Nom, prénom, email..." 
                            class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        >
                    </div>

                    {{-- Filtre par rôle --}}
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">👔 Rôle</label>
                        <select 
                            name="role" 
                            class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        >
                            <option value="">Tous les rôles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Enseignant</option>
                            <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Étudiant</option>
                        </select>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex items-end space-x-2">
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-3 sm:px-4 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all shadow-md hover:shadow-lg"
                        >
                            Filtrer
                        </button>
                        <a 
                            href="{{ route('admin.users.index') }}" 
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 sm:px-4 py-2 rounded-lg text-sm sm:text-base font-semibold transition-all"
                        >
                            <span class="hidden sm:inline">Réinitialiser</span>
                            <span class="sm:hidden">🔄</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Vue Mobile : Cards --}}
        <div class="lg:hidden space-y-4">
            @forelse($users as $user)
                <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-200 hover:shadow-xl transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-gray-900 truncate">
                                {{ $user->firstname }} {{ $user->lastname }}
                            </h3>
                            <p class="text-xs text-gray-600 truncate mt-1">{{ $user->email }}</p>
                            
                            <div class="flex items-center space-x-2 mt-2">
                                @if($user->role == 'admin')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">👔 Admin</span>
                                @elseif($user->role == 'teacher')
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">👨‍🏫 Enseignant</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">👨‍🎓 Étudiant</span>
                                @endif
                                <span class="text-xs text-gray-500">{{ $user->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="flex items-center space-x-2 mt-3 pt-3 border-t border-gray-100">
                                <button 
                                    onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->firstname) }}', '{{ addslashes($user->lastname) }}', '{{ $user->email }}', '{{ $user->role }}')" 
                                    class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                                >
                                    ✏️ Modifier
                                </button>
                                <form 
                                    action="{{ route('admin.users.destroy', $user->id) }}" 
                                    method="POST" 
                                    class="flex-1" 
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="w-full bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                                    >
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-200">
                    <div class="text-6xl mb-4">👤</div>
                    <p class="text-gray-500 text-sm">Aucun utilisateur trouvé</p>
                </div>
            @endforelse

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>

        {{-- Vue Desktop : Tableau (largeur réduite) --}}
        <div class="hidden lg:block">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Utilisateur</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Rôle</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Date</th>
                                <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-all duration-150">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-9 h-9 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md">
                                                {{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 max-w-xs truncate">{{ $user->email }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if($user->role == 'admin')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">👔 Admin</span>
                                        @elseif($user->role == 'teacher')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">👨‍🏫 Enseignant</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">👨‍🎓 Étudiant</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <button 
                                            onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->firstname) }}', '{{ addslashes($user->lastname) }}', '{{ $user->email }}', '{{ $user->role }}')" 
                                            class="text-blue-600 hover:text-blue-900 mr-3 font-semibold"
                                        >
                                            ✏️
                                        </button>
                                        <form 
                                            action="{{ route('admin.users.destroy', $user->id) }}" 
                                            method="POST" 
                                            class="inline-block" 
                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="text-6xl mb-4">👤</div>
                                        <p class="text-gray-500">Aucun utilisateur trouvé</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ajout (max-w-md = plus petit) --}}
<div id="addUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white flex items-center justify-between p-4 border-b border-gray-200 z-10">
            <h3 class="text-lg font-bold text-gray-900">➕ Ajouter un utilisateur</h3>
            <button onclick="closeModal('addUserModal')" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.users.store') }}" class="p-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom *</label>
                    <input type="text" name="firstname" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nom *</label>
                    <input type="text" name="lastname" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rôle *</label>
                    <select name="role" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Sélectionner --</option>
                        <option value="admin">Administrateur</option>
                        <option value="teacher">Enseignant</option>
                        <option value="student">Étudiant</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe *</label>
                    <input type="password" name="password" required minlength="8" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t">
                <button type="button" onclick="closeModal('addUserModal')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold">
                    Annuler
                </button>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg">
                    Créer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Modification (max-w-md = plus petit) --}}
<div id="editUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white flex items-center justify-between p-4 border-b border-gray-200 z-10">
            <h3 class="text-lg font-bold text-gray-900">✏️ Modifier l'utilisateur</h3>
            <button onclick="closeModal('editUserModal')" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form id="editUserForm" method="POST" class="p-4">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom *</label>
                    <input type="text" name="firstname" id="edit_firstname" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nom *</label>
                    <input type="text" name="lastname" id="edit_lastname" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Rôle *</label>
                    <select name="role" id="edit_role" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="admin">Administrateur</option>
                        <option value="teacher">Enseignant</option>
                        <option value="student">Étudiant</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 mt-6 pt-4 border-t">
                <button type="button" onclick="closeModal('editUserModal')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-semibold">
                    Annuler
                </button>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg">
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

    function openEditModal(id, firstname, lastname, email, role) {
        document.getElementById('editUserForm').action = `/admin/users/${id}`;
        document.getElementById('edit_firstname').value = firstname;
        document.getElementById('edit_lastname').value = lastname;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        openModal('editUserModal');
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('bg-opacity-50')) {
            closeModal('addUserModal');
            closeModal('editUserModal');
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal('addUserModal');
            closeModal('editUserModal');
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