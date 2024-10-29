<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Facilidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreFacilidadRequest;
use App\Http\Requests\Ambientes\UpdateFacilidadRequest;

class FacilidadController extends Controller
{
    // Obtener todas las facilidades
    public function index()
    {
        $facilidades = Facilidad::all();
        return response()->json([
            'success' => true,
            'data' => $facilidades,
            'error' => null,
            'message' => 'Lista de facilidades recuperada exitosamente'
        ]);
    }

    // Obtener una facilidad por su ID
    public function show($id)
    {
        $facilidad = Facilidad::find($id);

        if (!$facilidad) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Facilidad no encontrada',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $facilidad,
            'error' => null,
            'message' => 'Facilidad recuperada exitosamente'
        ]);
    }

    // Crear una nueva facilidad
    public function store(StoreFacilidadRequest $request)
    {
        $facilidad = Facilidad::create($request->validated());

        if ($request->has('aulas')) {
            $facilidad->aulas()->sync($request->aulas);
        }

        return response()->json([
            'success' => true,
            'data' => $facilidad,
            'error' => null,
            'message' => 'Facilidad registrada exitosamente'
        ], 201);
    }

    // Actualizar una facilidad existente
    public function update(UpdateFacilidadRequest $request, $id)
    {
        $facilidad = Facilidad::findOrFail($id);
        $facilidad->update($request->validated());

        if ($request->has('aulas')) {
            $facilidad->aulas()->sync($request->aulas);
        }

        return response()->json([
            'success' => true,
            'data' => $facilidad,
            'error' => null,
            'message' => 'Facilidad actualizada exitosamente'
        ]);
    }

    // Eliminar una facilidad
    public function destroy($id)
    {
        $facilidad = Facilidad::find($id);

        if (!$facilidad) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Facilidad no encontrada',
                'message' => ''
            ], 404);
        }

        $facilidad->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Facilidad eliminada exitosamente'
        ]);
    }
}

