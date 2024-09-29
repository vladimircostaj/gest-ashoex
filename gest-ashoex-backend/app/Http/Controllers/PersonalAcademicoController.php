<?php

namespace App\Http\Controllers;

use App\Models\PersonalAcademico;
use Illuminate\Http\Request;

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

        $personalAcademico->name = $request->input('name');
        $personalAcademico->email = $request->input('email');
        $personalAcademico->telefono = $request->input('telefono');
        $personalAcademico->estado = $request->input('estado');
        $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

        $personalAcademico->save();

        return response()->json([
            'message' => 'Personal académico actualizado exitosamente.',
            'personal_academico' => $personalAcademico
        ], 200);
    }

}
