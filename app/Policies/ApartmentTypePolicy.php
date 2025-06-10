<?php

namespace App\Policies;

use App\Models\ApartmentType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApartmentTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any apartment types.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the apartment type.
     */
    public function view(User $user, ApartmentType $apartmentType): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create apartment types.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can update the apartment type.
     */
    public function update(User $user, ApartmentType $apartmentType): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }

    /**
     * Determine whether the user can delete the apartment type.
     */
    public function delete(User $user, ApartmentType $apartmentType): bool
    {
        return in_array($user->role, ['super_admin', 'manager']);
    }
} 