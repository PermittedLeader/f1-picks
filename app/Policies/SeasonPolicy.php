<?php

namespace App\Policies;

use App\Models\Season;
use App\Models\User;

class SeasonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list seasons');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Season $season): bool
    {
        return $user->can('list seasons',$season);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create seasons');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Season $season): bool
    {
        return $user->can('edit seasons',$season);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Season $season): bool
    {
        return $user->can('delete seasons',$season);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Season $season): bool
    {
        return $user->can('restore seasons',$season);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Season $season): bool
    {
        return $user->can('forceDelete seasons',$season);
    }
}
