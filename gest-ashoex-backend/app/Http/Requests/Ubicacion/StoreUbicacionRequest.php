<?php

namespace App\Http\Requests\Ubicacion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'piso' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ubicacion')->where(function ($query) {
                    return $query->where('edificio_id', request()->edificio_id);
                }),
            ],
            'edificio_id' => 'required|exists:edificio,id',
        ];
    }

    public function messages(): array
    {
        return [
            "piso.required" => "El piso es requerido",
            "piso.string" => "El piso debe ser una cadena de texto",
            "piso.max" => "El piso no debe ser mayor a 255 caracteres",
            "edificio_id.required" => "El edificio es requerido",
            "edificio_id.exists" => "El edificio seleccionado no es válido",
            "edificio_id.exists" => "El edificio seleccionado no es válido",
            "piso.unique" => "Ya existe una ubicación con el mismo piso y edificio.",
        ];
    }
}
