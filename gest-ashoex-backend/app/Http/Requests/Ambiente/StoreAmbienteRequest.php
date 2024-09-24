<?php

namespace App\Http\Requests\Ambiente;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbienteRequest extends FormRequest
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
            'nombre_ambiente' => 'required|string|max:255|unique:ambiente,nombre_ambiente',
            'capacidad' => 'required|integer|min:1',
            'habilitada' => 'required|boolean',
            'ubicacion_id' => 'required|exists:ubicacion,id', 
        ];
    }

    public function messages(): array
    {
        return [
            "nombre_ambiente.required" => "El nombre del ambiente es requerido",
            "nombre_ambiente.string" => "El nombre del ambiente debe ser una cadena de texto",
            "nombre_ambiente.max" => "El nombre del ambiente no debe ser mayor a 255 caracteres",
            "nombre_ambiente.unique" => "El nombre del ambiente ya se registro",
            "capacidad.required" => "La capacidad del ambiente es requerida",
            "capacidad.integer" => "La capacidad del ambiente debe ser un entero",
            "capacidad.min" => "La capacidad del ambiente debe ser mayor o igual a 1",
            "habilitada.required" => "La propiedad habilitada del ambiente es requerida",
            "habilitada.boolean" => "La habilitada del ambiente debe ser un valor booleano",
            "ubicacion_id.required" => "La ubicación del ambiente es requerida", 
            "ubicacion_id.exists" => "La ubicación seleccionada no es válida", 
        ];
    }
}
