<?php

namespace App\Models;

use Illuminate\Validation\Rules\Password;
use App\Events\UserCreated;

use App\Traits\Validatable;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Validatable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    public function rules()
    {
        return [
            'name'=>'string|max:255|required',
            'email'=>[
                'required',
                Rule::unique('users','email')->ignore($this)
            ],
            'password' => ['required', Password::defaults()]
        ];
    }

    /**
     * The leagues that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function leagues(): BelongsToMany
    {
        return $this->belongsToMany(League::class, 'league_members');
    }

    /**
     * Get all of the picks for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function picks(): HasMany
    {
        return $this->hasMany(Pick::class);
    }

    public function adminOfLeagues(): MorphToMany
    {
        return $this->morphedByMany(League::class,'adminable');
    }

    public function adminOfEvents(): MorphToMany
    {
        return $this->morphedByMany(Event::class,'adminable');
    }

    public function adminOfSeasons(): MorphToMany
    {
        return $this->morphedByMany(Season::class,'adminable');
    }
}
