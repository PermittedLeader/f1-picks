<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePickRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update',[$this->pick,$this->event, $this->league, $this->season]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->pick->rules();
    }

    public function prepareForValidation()
    {
        $this->mergeIfMissing(['joker'=>false]);
        $this->merge(['user_id'=>auth()->id(),'joker'=>(bool) $this->input('joker')]);
    }
}
