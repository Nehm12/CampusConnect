<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = request()->user();
        
        $query = Reservation::with(['user', 'room', 'materials']);

        // Admin voit tout, autres voient seulement leurs réservations
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        // Filtrer par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservations = $query->orderBy('start_time', 'desc')->paginate(15);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $rooms = Room::orderBy('name')->get();
        $materials = Material::inStock()->orderBy('name')->get();
        
        return view('reservations.create', compact('rooms', 'materials'));
    }

    /**
     * Enregistrer une nouvelle réservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string|max:255',
            'materials' => 'nullable|array',
            'materials.*.id' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|integer|min:1',
        ]);

        // Vérifier disponibilité de la salle
        if ($request->filled('room_id')) {
            $room = Room::find($request->room_id);
            if (!$room->isAvailable($request->start_time, $request->end_time)) {
                return back()
                    ->withInput()
                    ->withErrors(['room_id' => 'Cette salle n\'est pas disponible pour cette période']);
            }
        }

        // Vérifier disponibilité des matériels
        if ($request->filled('materials')) {
            foreach ($request->materials as $materialData) {
                $material = Material::find($materialData['id']);
                $available = $material->getAvailableQuantity($request->start_time, $request->end_time);
                
                if ($available < $materialData['quantity']) {
                    return back()
                        ->withInput()
                        ->withErrors(['materials' => "Quantité insuffisante pour {$material->name} (disponible: {$available})"]);
                }
            }
        }

        // Créer la réservation
        $reservation = Reservation::create([
            'reference' => 'RES-' . strtoupper(Str::random(8)),
            'user_id' => request()->user()->id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        // Attacher les matériels
        if ($request->filled('materials')) {
            foreach ($request->materials as $materialData) {
                $reservation->materials()->attach(
                    $materialData['id'],
                    ['quantity' => $materialData['quantity']]
                );
            }
        }

        return redirect()
            ->route('reservations.show', $reservation)
            ->with('success', 'Réservation créée avec succès. En attente de validation.');
    }


    /**
     * Afficher une réservation
     */
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        
        $reservation->load(['user', 'room', 'materials', 'admin']);
        
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);

        if (!$reservation->canBeCancelled()) {
            return back()->withErrors(['error' => 'Cette réservation ne peut plus être annulée']);
        }

        $reservation->cancel();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Réservation annulée');
    }
}