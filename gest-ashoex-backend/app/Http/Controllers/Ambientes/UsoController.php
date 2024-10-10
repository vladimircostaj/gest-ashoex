<?php

namespace App\Http\Controllers\Ambientes;

use App\Http\Controllers\Controller;
use App\Models\Ambientes\Uso;
use Illuminate\Http\Request;

class UsoController extends Controller
{
    // Obtener todos los usos
    public function index()
    {
        return Uso::all();
    }

    // Obtener un uso por su ID
    public function show($id)
    {
        return Uso::findOrFail($id);
    }

    // Crear un nuevo uso
    public function store(Request $request)
    {
        $request->validate([
            'tipo_uso' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $uso = Uso::create($request->all());

        return response()->json($uso, 201);
    }

    // Actualizar un uso existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_uso' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $uso = Uso::findOrFail($id);
        $uso->update($request->all());

        return response()->json($uso, 200);
    }

    // Eliminar un uso
    public function destroy($id)
    {
        $uso = Uso::findOrFail($id);
        $uso->delete();

        return response()->json(null, 204);
    }
}
