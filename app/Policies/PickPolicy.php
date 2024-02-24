<?php

namespace App\Policies;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Illuminate\Auth\Access\Response;

class PickPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list picks');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pick $pick): bool
    {
        return $user->hasPermissionTo('list picks');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Event $event, League $league, Season $season): bool
    {
        if($user->leagues->contains($league) && $league->events->contains($event) && $user->picks()->where('event_id',$event)
        ->where('league_id',$league)
        ->where('season_id',$season)
        ->count() == 0){
            return true;
        }
        return $user->hasPermissionTo('create picks');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pick $pick): bool
    {
        return $user->hasPermissionTo('edit picks');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pick $pick): bool
    {
        return $user->hasPermissionTo('delete picks');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pick $pick): bool
    {
        return $user->hasPermissionTo('restore picks');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pick $pick): bool
    {
        return $user->hasPermissionTo('forceDelete picks');
    }
}
