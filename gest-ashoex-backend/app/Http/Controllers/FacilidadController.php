<?php

namespace App\Http\Controllers;

use App\Models\Facilidad;
use Illuminate\Http\Request;

class FacilidadController extends Controller
{
    // Obtener todas las facilidades
    public function index()
    {
        return Facilidad::all();
    }

    // Obtener una facilidad por su ID
    public function show($id)
    {
        return Facilidad::findOrFail($id);
    }

    // Crear una nueva facilidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre_facilidad' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $facilidad = Facilidad::create($request->all());

        return response()->json($facilidad, 201);
    }

    // Actualizar una facilidad existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_facilidad' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $facilidad = Facilidad::findOrFail($id);
        $facilidad->update($request->all());

        return response()->json($facilidad, 200);
    }

    // Eliminar una facilidad
    public function destroy($id)
    {
        $facilidad = Facilidad::findOrFail($id);
        $facilidad->delete();

        return response()->json(null, 204);
    }
}

