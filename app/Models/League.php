<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class League extends Model
{
    use HasFactory, Validatable, SoftDeletes, HasRelationships;

    protected $fillable = [
        'name',
        'description'
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'description'=>'nullable'
        ];
    }

    /**
     * The seasons that belong to the League
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class);
    }

    /**
     * The members that belong to the League
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'league_members');
    }

    public function scopeJoinable(Builder $builder, User $user)
    {
        $builder->whereDoesntHave("members", function ($query) use ($user) {
            $query->where("users.id", $user->id);
        })->get();
    }

    public function events()
    {
        return $this->hasManyDeepFromRelations($this->seasons(),(new Season())->events())->withIntermediate(Season::class,['id','name']);
    }
}
