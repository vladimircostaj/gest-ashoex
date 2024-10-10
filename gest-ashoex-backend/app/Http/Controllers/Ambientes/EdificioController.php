<?php

namespace App\Http\Controllers\Ambientes;

use App\Http\Controllers\Controller;
use App\Models\Ambientes\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    // Obtener todos los edificios con sus ubicaciones
    public function index()
    {
        return Edificio::with('ubicaciones')->get();
    }

    // Obtener un edificio por su ID, incluyendo las ubicaciones, aulas, usos y facilidades
    public function show($id)
    {
        return Edificio::with('ubicaciones.aulas.usos', 'ubicaciones.aulas.facilidades')->findOrFail($id);
    }

    // Crear un nuevo edificio
    public function store(Request $request)
    {
        $request->validate([
            'nombre_edificio' => 'required|string|max:100',
            'geolocalizacion' => 'nullable|string|max:255',
        ]);

        $edificio = Edificio::create($request->all());

        return response()->json($edificio, 201);
    }

    // Actualizar un edificio existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_edificio' => 'required|string|max:100',
            'geolocalizacion' => 'nullable|string|max:255',
        ]);

        $edificio = Edificio::findOrFail($id);
        $edificio->update($request->all());

        return response()->json($edificio, 200);
    }

    // Eliminar un edificio
    public function destroy($id)
    {
        $edificio = Edificio::findOrFail($id);
        $edificio->delete();

        return response()->json(null, 204);
    }
}
