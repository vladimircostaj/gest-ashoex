<?php

namespace App\Http\Requests;

use App\Exceptions\PersonalAcademicoNotFoundException;
use App\Models\PersonalAcademico;
use Illuminate\Foundation\Http\FormRequest;

class DarBajaPersonalRequest extends FormRequest
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
            'id' => 'required|integer|exists:personal_academicos,id',
        ];
    }

    protected function prepareForValidation()
    {
        $id = $this->route('id');

        //if (!PersonalAcademico::where('id', $id)->exists()) {
        //    throw new PersonalAcademicoNotFoundException();
        //}
        $this->merge(['id' => $id]);
    }

}
