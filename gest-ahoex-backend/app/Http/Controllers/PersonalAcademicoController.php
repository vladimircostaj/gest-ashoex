<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalAcademico;

class PersonalAcademicoController extends Controller
{

    public function update(Request $request, $id)
    {

        $personalAcademico = PersonalAcademico::find($id);

        if (!$personalAcademico) {
            return response()->json([
                'message' => 'Personal académico no encontrado.'
            ], 404);
        }

        $personalAcademico->nombre = $request->input('nombre');
        $personalAcademico->email = $request->input('email');
        $personalAcademico->telefono = $request->input('telefono');
        $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

        $personalAcademico->save();

        return response()->json([
            'message' => 'Personal académico actualizado exitosamente.',
            'personal_academico' => $personalAcademico
        ], 200);
    }
}
