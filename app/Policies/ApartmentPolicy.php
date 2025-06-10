<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any apartments.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the apartment.
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create apartments.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can update the apartment.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can delete the apartment.
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }
} 