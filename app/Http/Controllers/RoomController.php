<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Liste des salles
     */
    public function index(Request $request)
    {
        $query = Room::query();

        // Recherche
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Capacité minimale
        if ($request->filled('min_capacity')) {
            $query->minCapacity($request->min_capacity);
        }

        $rooms = $query->orderBy('name')->paginate(20);

        return view('rooms.index', compact('rooms'));
    }

     /**
     * Formulaire de création (Admin)
     */
    public function create()
    {
        $this->authorize('create', Room::class);
        
        return view('rooms.create');
    }

     /**
     * Enregistrer une nouvelle salle (Admin)
     */
    public function store(Request $request)
    {
        $this->authorize('create', Room::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:rooms,code',
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $room = Room::create($validated);

        return redirect()
            ->route('rooms.show', $room)
            ->with('success', 'Salle créée avec succès');
    }

    /**
     * Afficher une salle
     */
    public function show(Room $room)
    {
        // Réservations à venir pour cette salle
        $upcomingReservations = $room->reservations()
            ->with('user')
            ->approved()
            ->upcoming()
            ->orderBy('start_time')
            ->get();

        return view('rooms.show', compact('room', 'upcomingReservations'));
    }

    /**
     * Formulaire d'édition (Admin)
     */
    public function edit(Room $room)
    {
        $this->authorize('update', $room);
        
        return view('rooms.edit', compact('room'));
    }


    /**
     * Mettre à jour une salle (Admin)
     */
    public function update(Request $request, Room $room)
    {
        $this->authorize('update', $room);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:rooms,code,' . $room->id,
            'capacity' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()
            ->route('rooms.show', $room)
            ->with('success', 'Salle mise à jour');
    }

    /**
     * Supprimer une salle (Admin)
     */
    public function destroy(Room $room)
    {
        $this->authorize('delete', $room);

        // Vérifier s'il y a des réservations à venir
        $hasUpcomingReservations = $room->reservations()
            ->approved()
            ->upcoming()
            ->exists();

        if ($hasUpcomingReservations) {
            return back()->withErrors(['error' => 'Impossible de supprimer une salle avec des réservations à venir']);
        }

        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Salle supprimée');
    }
}