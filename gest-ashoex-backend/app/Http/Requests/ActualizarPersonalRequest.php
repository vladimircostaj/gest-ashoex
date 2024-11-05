<?php

namespace App\Http\Requests;

use App\Exceptions\PersonalAcademicoNotFoundException;
use App\Models\PersonalAcademico;
use Illuminate\Foundation\Http\FormRequest;

class ActualizarPersonalRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:personal_academicos,email,' . $this->route('id'),
            'telefono' => 'required|string|max:20',
            'estado' => 'required|string|in:ACTIVO,DESPEDIDO',
            'tipo_personal_id' => 'required|integer|exists:tipo_personals,id'
        ];
    }

    protected function prepareForValidation()
    {
        $id = $this->route('id');

        if (!PersonalAcademico::where('id', $id)->exists()) {
            throw new PersonalAcademicoNotFoundException();
        }
    }

}
