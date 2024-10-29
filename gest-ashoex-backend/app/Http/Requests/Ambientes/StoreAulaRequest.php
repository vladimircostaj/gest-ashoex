<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class StoreAulaRequest extends FormRequest
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
            'numero_aula' => 'required|string|max:30|unique:aulas,numero_aula',
            'capacidad' => 'nullable|integer',
            'habilitada' => 'boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
            'id_uso' => 'required|exists:uso,id_uso',
            'facilidades' => 'required|array',
            'facilidades.*' => 'exists:facilidad,id_facilidad',
        ];
    }
}
