<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /**
     * The pickables that belong to the Season
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pickables(): BelongsToMany
    {
        return $this->belongsToMany(Pickable::class);
    }
}
