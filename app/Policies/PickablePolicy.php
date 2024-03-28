<?php

namespace App\Policies;

use App\Models\Pickable;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PickablePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pickables');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pickable $pickable): bool
    {
        return $user->hasPermissionTo('view pickables');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pickables');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pickable $pickable): bool
    {
        return $user->hasPermissionTo('edit pickables');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pickable $pickable): bool
    {
        return $user->hasPermissionTo('delete pickables');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pickable $pickable): bool
    {
        return $user->hasPermissionTo('restore pickables');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pickable $pickable): bool
    {
        return $user->hasPermissionTo('forceDelete pickables');
    }
}
