<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Permittedleader\TablesForLaravel\Traits\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    use HasFactory, Validatable, SoftDeletes, HasRelationships, Searchable;

    protected $searchableFields = ['*'];

    public $fillable = [
        'name',
        'date',
        'pick_date'
    ];

    protected $casts = [
        'date' => 'datetime',
        'pick_date' => 'datetime'
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'pick_date' => 'required|date|before:date'
        ];
    }

    /**
     * The seasons that belong to the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class)->distinct();
    }

    /**
     * Get all of the pickables for the Event
     *
     */
    public function pickables(Season $season)
    {
        return $this->seasons()->where('seasons.id',$season->id)->first()->pickables();
    }

    public function availablePicks(League $league, Season $season, ?User $user = null)
    {
        if(is_null($user)){
            $user = auth()->user();
        }
        $userPicks = $user
            ->picks()
            ->where('league_id', $league->id)
            ->where('season_id', $season->id)
            ->whereNot('event_id',$this->id)
            ->get()->pluck('pickable.id');
        return $this->pickables($season)->whereNotIn('pickables.id', $userPicks)->get();
    }

    /**
     * The admins that belong to the League
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function admins(): MorphToMany
    {
        return $this->morphToMany(User::class, 'adminable');
    }

    /**
     * Get all of the picks for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }
}
