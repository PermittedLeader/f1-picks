<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Facades\App\Models\League;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeagueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create',League::getFacadeRoot());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return League::rules();
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug'=>$this->slug.'-'.Str::random(4),
            'password'=>Str::random(10)
        ]);
    }
}
