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
}
