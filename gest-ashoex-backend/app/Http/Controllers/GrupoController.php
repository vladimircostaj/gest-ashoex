<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::all();
       return response()->json($grupos,200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'materia_id' =>'required',
            'nro_grupo' => 'required',
        ]);
        $grupo = new Grupo($datos);
        $grupo->save();
        return response()->json($grupo,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grupo = Grupo::find($id);
        return response()->json($grupo,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grupo = Grupo::find($id);
        if (!$grupo) {
            return response()->json(['error' => 'Grupo no encontrado'], 404);
        }

        // Validación de los datos
        $datos = $request->validate([
            'materia_id' => 'required',
            'nro_grupo' => 'required',
        ]);

        // Actualizar el grupo con los datos validados
        $grupo->update($datos);

        return response()->json([
            'success' => true,
            'data' => $grupo
        ], 200);
    }


    public function destroy(string $id)
    {
        $grupo = Grupo::find($id)->delete();
        return response()->json([
            'success'=>true,
            'data'=> $grupo
        ],200);
    }
}
