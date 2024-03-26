<?php

namespace App\Policies;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Carbon\Carbon;
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
        if(
            $user->leagues->contains($league) && 
            $league->events->contains($event) && 
            $user->picks()->where('event_id',$event->id)
                ->where('league_id',$league->id)
                ->where('season_id',$season->id)
                ->count() == 0 && 
            $event->pick_date > Carbon::now()
        ){
            return true;
        }
        return $user->hasPermissionTo('create picks');
    }

    /**
     * Determine whether the user can create models.
     */
    public function update(User $user, Pick $pick, Event $event, League $league, Season $season): bool
    {
        return $event->pick_date > Carbon::now();
        if(
            $user->leagues->contains($league) && 
            $league->events->contains($event) && 
            $pick->user_id == $user->id && 
            $user->picks()->where('event_id',$event->id)
                ->where('league_id',$league->id)
                ->where('season_id',$season->id)
                ->count() > 0 && 
            $event->pick_date > Carbon::now()){
            return true;
        }
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

    public function adminCreate(User $user): bool
    {
        return $user->hasPermissionTo('create picks');
    }

    public function adminUpdate(User $user): bool
    {
        return $user->hasPermissionTo('edit picks');
    }
}
