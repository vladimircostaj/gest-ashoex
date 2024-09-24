<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalAcademico;
use App\Models\TipoPersonal;

class PersonalAcademicoController extends Controller
{
    public function store(Request $request)
    {
        $personalAcademico = new PersonalAcademico();
        $personalAcademico->nombre = $request->input('nombre');
        $personalAcademico->email = $request->input('email');
        $personalAcademico->telefono = $request->input('telefono');
        $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');
        $personalAcademico->save();

        return response()->json([
            'message' => 'Personal académico registrado exitosamente.',
            'personal_academico' => $personalAcademico
        ], 201);
    }
}

