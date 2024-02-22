<?php

namespace App\Http\Requests;

use Facades\App\Models\Pick;
use Illuminate\Foundation\Http\FormRequest;

class StorePickRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create picks',['event'=>$this->event, 'league'=>$this->league]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Pick::rules();
    }

    public function prepareForValidation()
    {
        $this->merge(['user_id'=>auth()->id()]);
    }
}
