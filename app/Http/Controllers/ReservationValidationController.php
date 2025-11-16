<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationValidationController extends Controller
{
    public function index()
    {
        $this->authorize('validate', Reservation::class);

        $pendingReservations = Reservation::with(['user', 'room', 'materials'])
            ->pending()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('reservations.validation.index', compact('pendingReservations'));
    }

    /**
     * Approuver une réservation
     */
    public function approve(Reservation $reservation)
    {
        $this->authorize('validate', $reservation);

        if ($reservation->status !== 'pending') {
            return back()->withErrors(['error' => 'Cette réservation a déjà été traitée']);
        }

        $reservation->approve(request()->user()->id);

        return back()->with('success', 'Réservation approuvée');
    }

     /**
     * Rejeter une réservation
     */
    public function reject(Request $request, Reservation $reservation)
    {
        $this->authorize('validate', $reservation);

        if ($reservation->status !== 'pending') {
            return back()->withErrors(['error' => 'Cette réservation a déjà été traitée']);
        }

        $reservation->reject(request()->user()->id);

        return back()->with('success', 'Réservation rejetée');
    }
}