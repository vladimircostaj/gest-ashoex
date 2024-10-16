<?php

namespace App\Http\Controllers\Ambientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreEdificioRequest;
use App\Http\Requests\Ambientes\UpdateEdificioRequest;
use App\Models\Ambientes\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    // Obtener todos los edificios con sus ubicaciones
    public function index()
    {
        $edificios = Edificio::with('ubicaciones')->get();
        return response()->json([
            'success' => true,
            'data' => $edificios,
            'error' => null,
            'message' => 'Lista de edificios recuperada exitosamente'
        ]);
    }

    // Obtener un edificio por su ID, incluyendo las ubicaciones, aulas, usos y facilidades
    public function show($id)
    {
        $edificio= Edificio::with('ubicaciones.aulas.usos', 'ubicaciones.aulas.facilidades')->findOrFail($id);
        if (!$edificio) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Edificio no encontrado',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $edificio,
            'error' => null,
            'message' => 'Edificio recuperado exitosamente'
        ]);
    }

    // Crear un nuevo edificio
    public function store(StoreEdificioRequest $request)
    {
        $edificio = Edificio::create($request->validated());
        return response()->json([
            'success' => true,
            'data' => $edificio,
            'message' => 'Edificio registrado exitosamente',
        ], 201);
    }

    // Actualizar un edificio existente
    public function update(UpdateEdificioRequest $request, $id)
    {
        $edificio = Edificio::findOrFail($id);
        $edificio->update($request->validated());
        return response()->json([
            'success' => true,
            'data' => $edificio,
            'message' => 'Edificio actualizado exitosamente',
        ]);
    }

    // Eliminar un edificio
    public function destroy($id)
    {
        $edificio = Edificio::find($id);
        if (!$edificio) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Edificio no encontrado',
                'message' => ''
            ], 404);
        }

        $edificio->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Edificio eliminado exitosamente'
        ]);
    }
}
