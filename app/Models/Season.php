<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Permittedleader\Tables\Traits\Searchable;

class Season extends Model
{
    use HasFactory, Validatable, SoftDeletes, Searchable;

    public $fillable = [
        'name',
        'joker_pick_count',
        'joker_restrictions'
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|string:255',
            'joker_pick_count'=>'integer|min:0',
            'joker_restrictions'=>'nullable|string'
        ];
    }

    public function hasJokers(): bool
    {
        return $this->joker_pick_count > 0;
    }

    public function hasJokerRestrictions(): Attribute
    {
        return Attribute::make(
            get: fn()=>!is_null($this->joker_restrictions)
        );
    }

    public function parse_joker_restrictions(): array
    {
        return $this->has_joker_restrictions ? json_decode($this->joker_restrictions) : [];
    }

    /**
     * Set and save joker restrictions for this season
     *
     * @param array $restrictions
     * @return bool
     */
    public function set_joker_restrictions(array $restrictions)
    {
        $this->joker_restrictions = json_encode($restrictions);
        return $this->save();
    }

    public function userHasJokerPickAvailable($user, $league):bool
    {
        if($this->hasJokers() && $user->picks()->where('league_id',$league->id)->where('season_id',$this->id)->where('joker',true)->count() < $this->joker_pick_count){
            return true;
        }

        return false;
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
