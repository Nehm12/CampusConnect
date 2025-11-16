<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoomPolicy
{
    /**
     * Voir toutes les salles
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir une salle
     */
    public function view(User $user, Room $room): bool
    {
        return true;
    }

    /**
     * Créer une salle (Admin uniquement)
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Modifier une salle (Admin uniquement)
     */
    public function update(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }

    /**
     * Supprimer une salle (Admin uniquement)
     */
    public function delete(User $user, Room $room): bool
    {
        return $user->isAdmin();
    }
}