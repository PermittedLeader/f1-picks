<?php

namespace App\Http\Requests;

use Facades\App\Models\Season;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create',Season::getFacadeRoot());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Season::rules();
    }
}
