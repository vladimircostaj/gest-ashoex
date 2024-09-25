<?php

namespace App\Http\Requests\Ubicacion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUbicacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'piso' => 'string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            "piso.string" => "El piso debe ser una cadena de texto",
            "piso.max" => "El piso no debe ser mayor a 255 caracteres",
        ];
    }
}
