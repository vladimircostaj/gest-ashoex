<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearGrupoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nro_grupo' => ['required', 'integer', 'min:1'],
            'materia_id' => ['required', 'exists:materias,id'],
        ];
    }
}