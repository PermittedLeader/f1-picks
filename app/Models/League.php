<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Permittedleader\Tables\Traits\Searchable;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class League extends Model
{
    use HasFactory, Validatable, SoftDeletes, HasRelationships, Searchable;

    protected $fillable = [
        'name',
        'description',
        'public',
        'slug'
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'description'=>'nullable',
            'public'=>'boolean',
            'slug'=> Rule::unique('leagues','slug')->ignore($this)
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
        });
    }

    public function scopePublic(Builder $builder)
    {
        $builder->where('public',true);
    }

    public function events()
    {
        return $this->hasManyDeepFromRelations($this->seasons(),(new Season())->events())->withIntermediate(Season::class,['id','name']);
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

    public function regeneratePassword(): bool
    {
        $this->forceFill([
            'password'=>Str::random(10)
        ]);

        return $this->save();
    }
}
