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
        return $user->can('list pickables');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pickable $pickable): bool
    {
        return $user->can('view pickables',$pickable);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create pickables');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pickable $pickable): bool
    {
        return $user->can('edit pickables',$pickable);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pickable $pickable): bool
    {
        return $user->can('delete pickables',$pickable);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pickable $pickable): bool
    {
        return $user->can('restore pickables',$pickable);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pickable $pickable): bool
    {
        return $user->can('forceDelete pickables',$pickable);
    }
}
