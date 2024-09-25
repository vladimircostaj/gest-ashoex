<?php

namespace App\Http\Controllers\Ubicacion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ubicacion\StoreUbicacionRequest;
use App\Http\Requests\Ubicacion\UpdateUbicacionRequest;
use App\Models\Ubicacion;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicaciones = Ubicacion::all();
        return response()->json([ 
            'Ubicaciones' => $ubicaciones
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUbicacionRequest $request)
    {
        $ubicacion = $request->validated();
        
        Ubicacion::create($ubicacion);
        return response()->json([
            'message' => 'Ubicacion guardada correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ubicacion = Ubicacion::find($id);
        if (!$ubicacion) {
            return response()->json(['error' => 'Ubicacion no encontrada'], 404);
        }
        return response()->json($ubicacion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUbicacionRequest $request, string $id)
    {
        $ubicacion = Ubicacion::find($id);
        if (!$ubicacion) {
            return response()->json(['error' => 'Ubicacion no encontrada'], 404);
        }
        $ubicacion_data = $request->validated();
        $ubicacion->update($ubicacion_data);
        return response()->json($ubicacion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ubicacion = Ubicacion::find($id);
        if (!$ubicacion) {
            return response()->json(['error' => 'Ubicacion no encontrada'], 404);
        }
        $ubicacion->delete();
        return response()->json(['message' => 'Ubicacion eliminada correctamente']);
    }
}
