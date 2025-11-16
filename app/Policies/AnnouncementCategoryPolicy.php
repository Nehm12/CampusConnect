<?php

namespace App\Policies;

use App\Models\AnnouncementCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AnnouncementCategoryPolicy
{
    /**
     * Voir toutes les catégories
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Créer une catégorie (Admin uniquement)
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Modifier une catégorie (Admin uniquement)
     */
    public function update(User $user, AnnouncementCategory $category): bool
    {
        return $user->isAdmin();
    }

    /**
     * Supprimer une catégorie (Admin uniquement)
     */
    public function delete(User $user, AnnouncementCategory $category): bool
    {
        return $user->isAdmin();
    }
}