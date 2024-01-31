<?php

namespace App\Http\Requests\Pokemon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:pokemons',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'serial_number' => 'required|numeric|unique:pokemons',
            'form' => 'required|in:head,head_legs,fins,wings',
            'longitude' => 'required|numeric|between:0,99.99',
            'latitude' => 'required|numeric|between:0,99.99'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],422));
    }
}
