<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list events');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('view events');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create events');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('edit events');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('delete events');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('restore events');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return $user->hasPermissionTo('forceDelete events');
    }

    public function makePick(User $user, Event $event, League $league, Season $season):bool
    {
        if($event->pick_date < Carbon::now()){
            return false;
        };
        return $user->picks()->where('event_id',$event->id)
            ->where('league_id',$league->id)
            ->where('season_id',$season->id)
            ->count() == 0 ? true : false;
    }

    public function changePick(
        User $user, 
        Event $event, 
        League $league, 
        Season $season
    ):bool
    {
        if($event->pick_date < Carbon::now()){
            return false;
        };
        return $user->picks()->where('event_id',$event->id)
            ->where('league_id',$league->id)
            ->where('season_id',$season->id)
            ->count() > 0 ? true : false;
    }

    public function score(
        User $user, 
        Event $event, 
        League $league, 
        Season $season
    ):bool
    {
        return $league->admins->contains($user);
    }
}
