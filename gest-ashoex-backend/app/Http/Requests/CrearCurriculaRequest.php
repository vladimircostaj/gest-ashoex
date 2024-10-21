<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearCurriculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permitir que todos los usuarios hagan esta solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'carrera_id' => 'required|integer|exists:carreras,id',
            'materia_id' => 'required|integer|exists:materias,id',
            'nivel' => 'nullable|integer',
            'electiva'=> 'integer',
        ];
    }
}