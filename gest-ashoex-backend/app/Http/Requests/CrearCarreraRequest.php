<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearCarreraRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:40', 'unique:carreras,nombre'],
            'nro_semestres' => ['required', 'numeric', 'min:1', 'max:12']
        ];
    }
}
