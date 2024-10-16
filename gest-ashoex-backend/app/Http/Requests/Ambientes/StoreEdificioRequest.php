<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class StoreEdificioRequest extends FormRequest
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
            'nombre_edificio' => 'required|string|max:100|unique:edificios,nombre_edificio',
            'geolocalizacion' => 'nullable|string|max:255',
        ];
    }
}
