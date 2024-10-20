<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoRequest extends FormRequest
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
            'materia_id' => 'required|exists:materias,id', // Requerido y debe existir en la tabla de materias
            'nro_grupo' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'materia_id.required' => 'La materia es obligatoria.',
            'materia_id.exists' => 'La materia seleccionada no es válida.',
            'nro_grupo.required' => 'El número de grupo es obligatorio.',
            'nro_grupo.integer' => 'El número de grupo debe ser un número entero.',
            'nro_grupo.min' => 'El número de grupo no puede ser negativo.',
            'nro_grupo.unique' => 'Ya existe un grupo con este número para la materia seleccionada.',
        ];
    }
}
