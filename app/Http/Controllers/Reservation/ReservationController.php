<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'room', 'admin', 'materials'])->latest()->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $rooms = Room::all();
        $materials = Material::all();
        return view('reservations.create', compact('rooms', 'materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'nullable|string|max:255',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $reservation = Reservation::create([
            'reference' => strtoupper(Str::uuid()),
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'room_id' => $validated['room_id'] ?? null,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'] ?? null,
            'status' => 'pending',
        ]);

        // Attach materials si fourni
        if (!empty($validated['materials'])) {
            foreach ($validated['materials'] as $index => $material_id) {
                $reservation->materials()->attach($material_id, ['quantity' => $validated['quantities'][$index] ?? 1]);
            }
        }

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'room', 'admin', 'materials']);
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $materials = Material::all();
        $reservation->load('materials');
        return view('reservations.edit', compact('reservation', 'rooms', 'materials'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'nullable|string|max:255',
            'status' => 'required|in:pending,approved,rejected,cancelled',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $reservation->update([
            'room_id' => $validated['room_id'] ?? null,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'purpose' => $validated['purpose'] ?? null,
            'status' => $validated['status'],
        ]);

        // Sync materials
        if (!empty($validated['materials'])) {
            $syncData = [];
            foreach ($validated['materials'] as $index => $material_id) {
                $syncData[$material_id] = ['quantity' => $validated['quantities'][$index] ?? 1];
            }
            $reservation->materials()->sync($syncData);
        } else {
            $reservation->materials()->detach();
        }

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }
}
