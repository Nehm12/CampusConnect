@extends('layouts.app')

@section('title', 'Gestion des ressources')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-50">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
        
        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 flex items-center">
                <span class="text-3xl sm:text-4xl mr-2 sm:mr-3">🏛️</span>
                Gestion des Ressources
            </h1>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base text-gray-600">Gérez les salles et le matériel disponibles</p>
        </div>

        {{-- Messages --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-3 sm:p-4 mb-4 sm:mb-6 rounded-lg shadow-md animate-fadeIn">
                <div class="flex items-start">
                    <span class="text-xl sm:text-2xl mr-2 sm:mr-3">✅</span>
                    <p class="text-green-800 font-semibold text-xs sm:text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- SECTION SALLES --}}
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-8 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">🏛️ Salles</h2>
                <button 
                    onclick="openModal('addRoomModal')" 
                    class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg transition-all"
                >
                    ➕ Ajouter une salle
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($rooms as $room)
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200 hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $room->name }}</h3>
                                <p class="text-sm text-gray-600">📍 {{ $room->location ?? 'Non spécifié' }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-600 text-white">
                                👥 {{ $room->capacity }}
                            </span>
                        </div>

                        @if($room->notes)
                            <p class="text-xs text-gray-600 mb-3">{{ Str::limit($room->notes, 50) }}</p>
                        @endif

                        <div class="flex items-center space-x-2">
                            <button 
                                onclick="openEditRoomModal({{ $room->id }}, '{{ addslashes($room->name) }}', '{{ addslashes($room->code ?? '') }}', {{ $room->capacity }}, '{{ addslashes($room->location ?? '') }}', '{{ addslashes($room->notes ?? '') }}')" 
                                class="flex-1 bg-white hover:bg-gray-50 text-blue-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                            >
                                ✏️ Modifier
                            </button>
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Supprimer cette salle ?')">
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
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Aucune salle enregistrée</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $rooms->links('pagination::tailwind') }}
            </div>
        </div>

        {{-- SECTION MATÉRIELS --}}
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">🔧 Matériels</h2>
                <button 
                    onclick="openModal('addMaterialModal')" 
                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-lg transition-all"
                >
                    ➕ Ajouter du matériel
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($materials as $material)
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200 hover:shadow-lg transition-all">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $material->name }}</h3>
                                <p class="text-sm text-gray-600">📍 {{ $material->location ?? 'Non spécifié' }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-600 text-white">
                                📦 {{ $material->quantity_total }}
                            </span>
                        </div>

                        @if($material->notes)
                            <p class="text-xs text-gray-600 mb-3">{{ Str::limit($material->notes, 50) }}</p>
                        @endif

                        <div class="flex items-center space-x-2">
                            <button 
                                onclick="openEditMaterialModal({{ $material->id }}, '{{ addslashes($material->name) }}', '{{ addslashes($material->code ?? '') }}', {{ $material->quantity_total }}, '{{ addslashes($material->location ?? '') }}', '{{ addslashes($material->notes ?? '') }}')" 
                                class="flex-1 bg-white hover:bg-gray-50 text-green-700 px-3 py-2 rounded-lg text-xs font-semibold transition-all"
                            >
                                ✏️ Modifier
                            </button>
                            <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Supprimer ce matériel ?')">
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
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Aucun matériel enregistré</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $materials->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>

{{-- MODALS SALLES --}}
<div id="addRoomModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-bold">🏛️ Nouvelle salle</h3>
            <button onclick="closeModal('addRoomModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.rooms.store') }}" class="p-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Code</label>
                    <input type="text" name="code" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Capacité *</label>
                    <input type="number" name="capacity" required min="1" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
                    <input type="text" name="location" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('addRoomModal')" class="bg-gray-200 px-4 py-2 rounded-lg">Annuler</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Créer</button>
            </div>
        </form>
    </div>
</div>

<div id="editRoomModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-bold">✏️ Modifier la salle</h3>
            <button onclick="closeModal('editRoomModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="editRoomForm" method="POST" class="p-4">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" id="edit_room_name" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Code</label>
                    <input type="text" name="code" id="edit_room_code" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Capacité *</label>
                    <input type="number" name="capacity" id="edit_room_capacity" required min="1" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
                    <input type="text" name="location" id="edit_room_location" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="edit_room_notes" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('editRoomModal')" class="bg-gray-200 px-4 py-2 rounded-lg">Annuler</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALS MATÉRIELS --}}
<div id="addMaterialModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-bold">🔧 Nouveau matériel</h3>
            <button onclick="closeModal('addMaterialModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.materials.store') }}" class="p-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Code</label>
                    <input type="text" name="code" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Quantité totale *</label>
                    <input type="number" name="quantity_total" required min="1" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
                    <input type="text" name="location" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('addMaterialModal')" class="bg-gray-200 px-4 py-2 rounded-lg">Annuler</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Créer</button>
            </div>
        </form>
    </div>
</div>

<div id="editMaterialModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-4 border-b">
            <h3 class="text-lg font-bold">✏️ Modifier le matériel</h3>
            <button onclick="closeModal('editMaterialModal')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <form id="editMaterialForm" method="POST" class="p-4">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom *</label>
                    <input type="text" name="name" id="edit_material_name" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Code</label>
                    <input type="text" name="code" id="edit_material_code" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Quantité totale *</label>
                    <input type="number" name="quantity_total" id="edit_material_quantity" required min="1" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Localisation</label>
                    <input type="text" name="location" id="edit_material_location" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="edit_material_notes" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="closeModal('editMaterialModal')" class="bg-gray-200 px-4 py-2 rounded-lg">Annuler</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById(modalId).classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.getElementById(modalId).classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function openEditRoomModal(id, name, code, capacity, location, notes) {
        document.getElementById('editRoomForm').action = `/admin/rooms/${id}`;
        document.getElementById('edit_room_name').value = name;
        document.getElementById('edit_room_code').value = code;
        document.getElementById('edit_room_capacity').value = capacity;
        document.getElementById('edit_room_location').value = location;
        document.getElementById('edit_room_notes').value = notes;
        openModal('editRoomModal');
    }

    function openEditMaterialModal(id, name, code, quantity, location, notes) {
        document.getElementById('editMaterialForm').action = `/admin/materials/${id}`;
        document.getElementById('edit_material_name').value = name;
        document.getElementById('edit_material_code').value = code;
        document.getElementById('edit_material_quantity').value = quantity;
        document.getElementById('edit_material_location').value = location;
        document.getElementById('edit_material_notes').value = notes;
        openModal('editMaterialModal');
    }
</script>
@endsection