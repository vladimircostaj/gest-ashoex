<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class StoreUbicacionRequest extends FormRequest
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
            'piso' => 'required|integer|min:0|max:5|unique:ubicacion,piso',
            'id_edificio' => 'required|exists:edificio,id_edificio',
        ];
    }

    public function messages(): array{
        return [
            'piso.required' => 'El piso es obligatorio.',
            'piso.integer' => 'El piso debe ser un número entero.',

            'id_edificio.required' => 'El edificio es obligatorio.',
            'id_edificio.exists' => 'El edificio seleccionado no es válido.',
        ];
    }
}
