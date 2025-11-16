<?php

namespace App\Policies;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Voir toutes les réservations
     */
    public function viewAny(User $user): bool
    {
        return true; // Chacun voit ses propres réservations
    }

    /**
     * Voir une réservation spécifique
     */
    public function view(User $user, Reservation $reservation): bool
    {
        // L'utilisateur qui a créé ou un admin
        return $user->id === $reservation->user_id || $user->isAdmin();
    }

    /**
     * Créer une réservation
     */
    public function create(User $user): bool
    {
        return true; // Tout le monde peut créer une réservation
    }

    /**
     * Annuler une réservation
     */
    public function delete(User $user, Reservation $reservation): bool
    {
        // Seulement l'utilisateur qui l'a créée
        return $user->id === $reservation->user_id && $reservation->canBeCancelled();
    }

    /**
     * Valider/Rejeter une réservation (Admin uniquement)
     */
    public function validate(User $user, ?Reservation $reservation = null): bool
    {
        return $user->canValidateReservations();
    }
}