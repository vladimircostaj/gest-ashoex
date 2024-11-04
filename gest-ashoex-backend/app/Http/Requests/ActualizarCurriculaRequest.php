<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Curricula;
use App\Models\Carrera;


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
                $carreraId = $this->input('carrera_id');
                if (!is_numeric($value) || !is_numeric($carreraId)) {
                    return;
                }

                if ($curriculaId) {
                    $exists = Curricula::where('carrera_id', $carreraId)
                        ->where('materia_id', $value)
                        ->where('id', '!=', $curriculaId)
                        ->exists();

                    if ($exists) {
                        $fail("Ya existe una Curricula con los mismos carrera_id y materia_id");
                    }
                }
            },
        ],
        'nivel' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) {
                $carreraId = $this->input('carrera_id');
                if (!is_numeric($value) || !is_numeric($carreraId)) {
                    return;
                }
                $carrera = Carrera::find($carreraId);
                if ($carrera && $value > $carrera->nro_semestres) {
                    $fail("El nivel no puede ser mayor que el número de semestres de la carrera");
                }
            },
        ],
        'electiva' => 'required|boolean',
    ];
}
}
