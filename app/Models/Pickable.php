<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pickable extends Model
{
    use HasFactory, Validatable, SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'team',
        'short_name'
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|max:255|string',
            'avatar'=>'nullable',
            'team'=>'nullable|max:255|string',
            'short_name'=>'nullable|max:5|string'
        ];
    }

    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: fn($value)=>Str::upper($value),
            set: fn($value)=>Str::upper($value)
        );
    }
    

    /**
     * The seasons that belong to the Pickable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seasons(): BelongsToMany
    {
        return $this->belongsToMany(Season::class);
    }
}
