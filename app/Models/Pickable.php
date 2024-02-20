<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pickable extends Model
{
    use HasFactory, Validatable, SoftDeletes;

    protected $fillable = [
        'name',
        'avatar',
        'team',
    ];

    public function rules(): array
    {
        return [
            'name'=>'required|max:255|string',
            'avatar'=>'nullable',
            'team'=>'nullable|max:255|string'
        ];
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
