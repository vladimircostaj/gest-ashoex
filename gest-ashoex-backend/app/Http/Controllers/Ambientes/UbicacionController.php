<?php

namespace App\Http\Controllers\Ambientes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreUbicacionRequest;
use App\Http\Requests\Ambientes\UpdateUbicacionRequest;
use App\Models\Ambientes\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    // Obtener todas las ubicaciones con sus aulas
    public function index()
    {
        $ubicaciones = Ubicacion::with('aulas')->get();
        return response()->json([
            'success' => true,
            'data' => $ubicaciones,
            'error' => null,
            'message' => 'Lista de ubicaciones recuperada exitosamente'
        ]);
    }

    // Obtener una ubicación por su ID, incluyendo las aulas, usos y facilidades
    public function show($id)
    {
        $ubicacion = Ubicacion::with('aulas.usos', 'aulas.facilidades')->findOrFail($id);

        if (!$ubicacion) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Ubicación no encontrada',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación recuperada exitosamente'
        ]);
    }

    // Crear una nueva ubicación
    public function store(StoreUbicacionRequest $request)
    {
        $ubicacion = Ubicacion::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación registrada exitosamente'
        ], 201);
    }

    // Actualizar una ubicación existente
    public function update(UpdateUbicacionRequest $request, $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación actualizada exitosamente'
        ]);
    }

    // Eliminar una ubicación
    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Ubicación no encontrada',
                'message' => ''
            ], 404);
        }

        $ubicacion->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Ubicación eliminada exitosamente'
        ]);
    }
}

