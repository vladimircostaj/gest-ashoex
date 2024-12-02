<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearMateriaRequest extends FormRequest
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
            'codigo' => ['required','integer', 'unique:materias,codigo'],
            'nombre' => ['required', 'string', 'max:80','alpha'],
            'tipo' => ['required', 'string','max:20','alpha'],
            'nro_PeriodoAcademico' => ['required', 'integer'],
        ];
    }


    
}
