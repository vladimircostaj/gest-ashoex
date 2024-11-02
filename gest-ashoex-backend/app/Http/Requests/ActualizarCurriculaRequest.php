<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Curricula;


class ActualizarCurriculaRequest extends FormRequest
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
            'carrera_id' => [
                'required',
                'integer',
                'exists:carreras,id',
            ],
            'materia_id' => [
                'required',
                'integer',
                'exists:materias,id',
                function ($attribute, $value, $fail) {
                    $curriculaId = $this->route('id');
                    $carreraId=$this->input('carrera_id');
                    if (!is_numeric($value)) {
                        return;
                    }else if(!is_numeric($carreraId)){
                        return;
                    }
                    
                    if (!$curriculaId) {
                        return;
                    }    
                    $exists = Curricula::where('carrera_id', $this->input('carrera_id'))
                        ->where('materia_id', $value)
                        ->where('id', '!=', $curriculaId)
                        ->exists();
    
                    if ($exists) {
                        $fail("La combinación de carrera y materia ya existe en la base de datos.");
                    }
                },
            ],
            'nivel' => [
                'required',
                'integer',
                'min:1',
            ],
            'electiva' => 'required|boolean',
        ];
    }
}
