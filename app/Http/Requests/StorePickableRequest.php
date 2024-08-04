<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Facades\App\Models\Pickable;
use Illuminate\Foundation\Http\FormRequest;

class StorePickableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create',Pickable::getFacadeRoot());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Pickable::rules();
    }

    public function prepareForValidation(): void
    {
        $this->mergeIfMissing(['short_name'=>Str::upper(Str::limit($this->input('name'),3))]);
    }
}
