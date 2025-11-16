<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnouncementPolicy
{
    /**
     * Tout le monde peut voir les annonces publiées
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir une annonce spécifique
     */
    public function view(User $user, Announcement $announcement): bool
    {
        // Publiée = tout le monde
        if ($announcement->is_published) {
            return true;
        }
        
        // Brouillon = seulement auteur ou admin
        return $user->id === $announcement->user_id || $user->isAdmin();
    }

    /**
     * Créer une annonce (enseignants et admins)
     */
    public function create(User $user): bool
    {
        return $user->canManageAnnouncements();
    }

    /**
     * Modifier une annonce
     */
    public function update(User $user, Announcement $announcement): bool
    {
        // L'auteur ou un admin
        return $user->id === $announcement->user_id || $user->isAdmin();
    }

    /**
     * Supprimer une annonce
     */
    public function delete(User $user, Announcement $announcement): bool
    {
        // L'auteur ou un admin
        return $user->id === $announcement->user_id || $user->isAdmin();
    }
}