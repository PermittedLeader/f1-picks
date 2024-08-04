<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Season extends Model
{
    use HasFactory, Validatable, SoftDeletes;

    public $fillable = [
        'name',
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|string:255'
        ];
    }

    /**
     * The events that belong to the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function eventsWithoutPicksForUser(User $user,League $league)
    {
        return $this->events()->whereNotIn('events.id',$user->picks->where(
            fn($query) => $query->where("season_id", $this->id)->where("league_id", $league->id)
        )->pluck('event_id'))->get();
    }

    /**
     * The pickables that belong to the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pickables(): BelongsToMany
    {
        return $this->belongsToMany(Pickable::class)->withPivot('order')->orderByPivot('order');
    }

     /**
     * The admins that belong to the League
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function admins(): MorphToMany
    {
        return $this->morphToMany(User::class,'adminable');
    }
}
