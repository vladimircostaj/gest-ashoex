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
            'numero_aula' => 'required|string|max:30|unique:aula,numero_aula',
            'capacidad' => 'required|integer|min:15|max:400',
            'habilitada' => 'required|boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
            'usos' => 'required|array',
            'usos.*' => 'exists:uso,id_uso',
            'facilidades' => 'required|array',
            'facilidades.*' => 'exists:facilidad,id_facilidad',
        ];
    }

    public function messages(): array{
        return [
            'numero_aula.required' => 'El número del aula es obligatorio.',
            'numero_aula.string' => 'El número del aula debe ser una cadena de texto.',
            'numero_aula.max' => 'El número del aula no puede tener más de 30 caracteres.',
            'numero_aula.unique' => 'Este número de aula ya está registrado.',

            'capacidad.integer' => 'La capacidad debe ser un número entero.',

            'habilitada.boolean' => 'El campo habilitada debe ser verdadero o falso.',

            'id_ubicacion.required' => 'La ubicación es obligatoria.',
            'id_ubicacion.exists' => 'La ubicación seleccionada no es válida.',

            'usos.required' => 'Debe seleccionar al menos un uso.',
            'usos.array' => 'El campo usos debe ser un arreglo.',
            'usos.*.exists' => 'Alguna de los usos seleccionadas no es válida.',

            'facilidades.required' => 'Debe seleccionar al menos una facilidad.',
            'facilidades.array' => 'El campo facilidades debe ser un arreglo.',
            'facilidades.*.exists' => 'Alguna de las facilidades seleccionadas no es válida.',
        ];
    }
}