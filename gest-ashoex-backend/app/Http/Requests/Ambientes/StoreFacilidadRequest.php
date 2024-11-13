<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacilidadRequest extends FormRequest
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
            'nombre_facilidad' => 'required|string|max:100|unique:facilidad,nombre_facilidad',
            'aulas' => 'sometimes|required|array',
            'aulas.*' => 'exists:aula,id_aula',
        ];
    }

    public function messages(): array{
        return [
            'nombre_facilidad.required' => 'El nombre de la facilidad es obligatorio.',
            'nombre_facilidad.string' => 'El nombre de la facilidad debe ser una cadena de texto.',
            'nombre_facilidad.max' => 'El nombre de la facilidad no puede tener más de 100 caracteres.',
            'nombre_facilidad.unique' => 'Este nombre de facilidad ya está registrado.',
            
            'aulas.array' => 'El campo aulas debe ser un arreglo.',
            'aulas.required' => 'Debe seleccionar al menos un aula.',
            'aulas.*.exists' => 'Alguna de las aulas seleccionadas no es válida.',
        ];
    }

}
