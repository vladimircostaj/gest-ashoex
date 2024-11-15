<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsoRequest extends FormRequest
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
            'tipo_uso' => 'required|string|max:100|unique:uso,tipo_uso',
        ];
    }

    public function messages()
    {
        return [
            'tipo_uso.required' => 'Debe ingresar un tipo de uso válido.',
            'tipo_uso.string' => 'El tipo de uso debe ser una cadena de texto.',
            'tipo_uso.max' => 'El tipo de uso no puede tener más de 100 caracteres.',
        ];
    }
}
