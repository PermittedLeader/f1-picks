<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pick extends Model
{
    use HasFactory, Validatable, SoftDeletes;

    public $fillable = [
        'event_id',
        'league_id',
        'pickable_id',
        'user_id'
    ];

    public function rules(): array
    {
        return [
            'event_id'=>'required|exists:events,id',
            'league_id'=>'required|exists:leagues,id',
            'pickable_id'=>'required|exists:pickables,id',
            'user_id'=>'required|exists:users,id'
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
}
