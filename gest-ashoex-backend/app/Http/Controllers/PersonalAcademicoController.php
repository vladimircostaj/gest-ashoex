<?php

namespace App\Http\Controllers;

use App\Models\PersonalAcademico;
use Illuminate\Http\Request;

class PersonalAcademicoController extends Controller
{
    public function registrar(Request $request)
    {
        $personalAcademico = PersonalAcademico::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'estado' => $request->estado,
            'tipo_personal_id' => $request->tipo_personal_id,
        ]);

        return response()->json([
            'message' => 'Personal académico registrado exitosamente',
            'personalAcademico' => $personalAcademico
        ], 201);
    }
}
