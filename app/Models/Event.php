<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Event extends Model
{
    use HasFactory, Validatable, SoftDeletes, HasRelationships;

    public $fillable = [
        'name',
        'date',
        'pick_date'
    ];

    protected $casts = [
        'date'=>'datetime',
        'pick_date'=>'datetime'
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'date'=>'required|date|after:today',
            'pick_date'=>'required|date|before:date'
        ];
    }

    /**
     * The seasons that belong to the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class);
    }

    /**
     * The admins that belong to the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'event_admins');
    }

    /**
     * Get all of the pickables for the Event
     *
     */
    public function pickables()
    {
        return $this->hasManyDeepFromRelations($this->seasons(),(new Season())->pickables());
    }
}
