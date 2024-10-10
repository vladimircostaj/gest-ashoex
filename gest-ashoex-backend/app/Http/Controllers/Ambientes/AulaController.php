<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Aula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AulaController extends Controller
{
    // Obtener todas las aulas con sus usos y facilidades
    public function index()
    {
        return Aula::with('usos', 'facilidades')->get();
    }

    // Obtener un aula por su ID, incluyendo sus usos y facilidades
    public function show($id)
    {
        return Aula::with('usos', 'facilidades')->findOrFail($id);
    }

    // Crear un nuevo aula
    public function store(Request $request)
    {
        $request->validate([
            'numero_aula' => 'required|string|max:10',
            'capacidad' => 'nullable|integer',
            'habilitada' => 'boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        $aula = Aula::create($request->all());

        return response()->json($aula, 201);
    }

    // Actualizar un aula existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_aula' => 'required|string|max:10',
            'capacidad' => 'nullable|integer',
            'habilitada' => 'boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($request->all());

        return response()->json($aula, 200);
    }

    // Eliminar un aula
    public function destroy($id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        return response()->json(null, 204);
    }
}
