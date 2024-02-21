<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('list events');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return $user->can('view events',$event);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create events');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->can('edit events',$event);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->can('delete events',$event);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return $user->can('restore events',$event);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return $user->can('forceDelete events',$event);
    }

    public function makePick(User $user, Event $event):bool
    {
        return $event->pick_date > Carbon::now() ? true : false;
    }

    public function changePick(User $user, Event $event):bool
    {
        return $event->pick_date > Carbon::now() ? true : false;
    }
}
