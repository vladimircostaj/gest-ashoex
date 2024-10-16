<?php

namespace App\Http\Controllers\Ambientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreUsoRequest;
use App\Http\Requests\Ambientes\UpdateUsoRequest;
use App\Models\Ambientes\Uso;
use Illuminate\Http\Request;

class UsoController extends Controller
{
    // Obtener todos los usos
    public function index()
    {
        $usos = Uso::all();
        return response()->json([
            'success' => true,
            'data' => $usos,
            'error' => null,
            'message' => 'Lista de usos recuperada exitosamente'
        ]);
    }

    // Obtener un uso por su ID
    public function show($id)
    {
        $uso = Uso::find($id);

        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso no encontrado',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso recuperado exitosamente'
        ]);
    }

    // Crear un nuevo uso
    public function store(StoreUsoRequest $request)
    {
         $uso = Uso::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso registrado exitosamente'
        ], 201);
    }

    // Actualizar un uso existente
    public function update(UpdateUsoRequest $request, $id)
    {
        $uso = Uso::findOrFail($id);
        $uso->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso actualizado exitosamente'
        ]);
    }

    // Eliminar un uso
    public function destroy($id)
    {
        $uso = Uso::find($id);

        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso no encontrado',
                'message' => ''
            ], 404);
        }

        $uso->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Uso eliminado exitosamente'
        ]);
    
    }
}
