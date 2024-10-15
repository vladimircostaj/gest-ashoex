<?php

namespace App\Http\Controllers;
use App\Http\Requests\GrupoRequest;
use App\Models\Grupo;
use Illuminate\Database\QueryException; // Para capturar errores de base de datos.
use Illuminate\Http\Response;

class GrupoController extends Controller{
    public function index()
    {
        $grupos = Grupo::all();
       return response()->json($grupos,200);
    }

    public function store(GrupoRequest $request)
    {
        try {
            // Crear un nuevo grupo con los datos validados
            $grupo = new Grupo($request->validated());
            $grupo->save();

            // Responder con el grupo creado y código 201 (Creado)
            return response()->json($grupo, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            // Código SQL 23000 se refiere a violaciones de integridad como duplicados
            if ($e->getCode() === '23000') {
                return response()->json([
                    'message' => 'Error: Ya existe un grupo con este número para la materia seleccionada.',
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Manejo de otros errores generales
            return response()->json([
                'message' => 'Error al crear el grupo.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function update(GrupoRequest $request, string $id)
    {
        $grupo = Grupo::find($id);
        if (!$grupo) {
            return response()->json(['error' => 'Grupo no encontrado'], 404);
        }

        // Actualiza el grupo con los datos validados
        $grupo->update($request->validated());

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
