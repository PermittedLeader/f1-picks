<?php

namespace App\Http\Requests;

use Facade\App\Models\Pickable;
use Illuminate\Foundation\Http\FormRequest;

class StorePickableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->authorize('create',Pickable::class);
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
}
