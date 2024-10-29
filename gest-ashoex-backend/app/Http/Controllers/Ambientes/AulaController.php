<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Aula;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreAulaRequest;
use App\Http\Requests\Ambientes\UpdateAulaRequest;

class AulaController extends Controller
{
    // Obtener todas las aulas con sus usos y facilidades
    public function index()
    {
        $aulas = Aula::with('uso', 'facilidades')->get();
        return response()->json([
            'success' => true,
            'data' => $aulas,
            'error' => null,
            'message' => 'Lista de aulas recuperada exitosamente'
        ]);
    }

    // Obtener un aula por su ID, incluyendo sus usos y facilidades
    public function show($id)
    {
        $aula = Aula::with('uso', 'facilidades')->findOrFail($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Aula no encontrada',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula recuperada exitosamente'
        ]);
    }

    // Crear un nuevo aula
    public function store(StoreAulaRequest $request)
    {
        $aula = Aula::create($request->validated());

        $aula->facilidades()->attach($request->facilidades);

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula registrada exitosamente'
        ], 201);
    }

    // Actualizar un aula existente
    public function update(UpdateAulaRequest $request, $id)
    {
        $aula = Aula::findOrFail($id);
        $aula = Aula::create($request->validated());

        if ($request->has('facilidades')) {
            $aula->facilidades()->sync($request->facilidades);
        }

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula actualizada exitosamente'
        ]);

    }

    // Eliminar un aula
    public function destroy($id)
    {
        $aula = Aula::find($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Aula no encontrada',
                'message' => ''
            ], 404);
        }

        $aula->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Aula eliminada exitosamente'
        ]);

    }
}
