<?php

namespace App\Policies;

use App\Models\Tower;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TowerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any towers.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the tower.
     */
    public function view(User $user, Tower $tower): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create towers.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can update the tower.
     */
    public function update(User $user, Tower $tower): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can delete the tower.
     */
    public function delete(User $user, Tower $tower): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }
} 