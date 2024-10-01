<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    // Obtener todas las ubicaciones con sus aulas
    public function index()
    {
        return Ubicacion::with('aulas')->get();
    }

    // Obtener una ubicación por su ID, incluyendo las aulas, usos y facilidades
    public function show($id)
    {
        return Ubicacion::with('aulas.usos', 'aulas.facilidades')->findOrFail($id);
    }

    // Crear una nueva ubicación
    public function store(Request $request)
    {
        $request->validate([
            'piso' => 'required|integer',
            'id_edificio' => 'required|exists:edificio,id_edificio',
        ]);

        $ubicacion = Ubicacion::create($request->all());

        return response()->json($ubicacion, 201);
    }

    // Actualizar una ubicación existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'piso' => 'required|integer',
            'id_edificio' => 'required|exists:edificio,id_edificio',
        ]);

        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->all());

        return response()->json($ubicacion, 200);
    }

    // Eliminar una ubicación
    public function destroy($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->delete();

        return response()->json(null, 204);
    }
}

