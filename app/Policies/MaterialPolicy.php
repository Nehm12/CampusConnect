<?php

namespace App\Policies;

use App\Models\Material;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
{
    /**
     * Voir tous les matériels
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Voir un matériel
     */
    public function view(User $user, Material $material): bool
    {
        return true;
    }

    /**
     * Créer un matériel (Admin uniquement)
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Modifier un matériel (Admin uniquement)
     */
    public function update(User $user, Material $material): bool
    {
        return $user->isAdmin();
    }

    /**
     * Supprimer un matériel (Admin uniquement)
     */
    public function delete(User $user, Material $material): bool
    {
        return $user->isAdmin();
    }
}