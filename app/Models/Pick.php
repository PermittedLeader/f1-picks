<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Permittedleader\Tables\Traits\Searchable;

class Pick extends Model
{
    use HasFactory, Validatable, SoftDeletes, Searchable;

    public $fillable = [
        'event_id',
        'league_id',
        'pickable_id',
        'season_id',
        'user_id',
        'score',
        'joker'
    ];

    public function rules(): array
    {
        return [
            'event_id'=>[
                'required',
                'exists:events,id',
                Rule::unique('picks')->where(function (Builder $query){
                    $query->where('league_id',$this->league);
                    $query->where('season_id',$this->season);
                    $query->where('user_id', auth()->id());
                })
            ],
            'league_id'=>'required|exists:leagues,id',
            'season_id'=>'required|exists:seasons,id',
            'pickable_id'=>'required|exists:pickables,id',
            'user_id'=>'required|exists:users,id',
            'joker'=>'sometimes|boolean'
        ];
    }

    /**
     * Get the user that owns the Pick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the league that owns the Pick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    /**
     * Get the pickable that owns the Pick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pickable(): BelongsTo
    {
        return $this->belongsTo(Pickable::class);
    }

    /**
     * Get the event that owns the Pick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the season that owns the Pick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}
