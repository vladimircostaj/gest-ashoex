<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEdificioRequest extends FormRequest
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
            'nombre_edificio' => 'required|string|max:100|unique:edificio,nombre_edificio',
            'geolocalizacion' => 'required|string|max:255|unique:edificio,geolocalizacion,',
        ];
    }

    public function messages(): array{
        return [
            'nombre_edificio.required' => 'El nombre del edificio es obligatorio.',
            'nombre_edificio.string' => 'El nombre del edificio debe ser una cadena de texto.',
            'nombre_edificio.max' => 'El nombre del edificio no puede tener más de 100 caracteres.',
            'nombre_edificio.unique' => 'Este nombre de edificio ya está registrado.',

            'geolocalizacion.string' => 'La geolocalización debe ser una cadena de texto.',
            'geolocalizacion.max' => 'La geolocalización no puede tener más de 255 caracteres.',
        ];
    }
}
