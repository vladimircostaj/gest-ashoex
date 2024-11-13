<?php

namespace App\Http\Requests\Ambientes;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsoRequest extends FormRequest
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
            'tipo_uso' => 'required|string|max:100',
        ];
    }
    public function messages()
    {
        return [
            'tipo_uso.required' => 'Debe ingresar un tipo de uso valido.',
        ];
    }
}
