<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ambiente\StoreAmbienteRequest;
use App\Http\Requests\Ambiente\UpdateAmbienteRequest;
use App\Models\Ambiente;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ambientes = Ambiente::all();
        return response()->json([ 
            'Ambientes' => $ambientes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbienteRequest $request)
    {
        //validar datos
        $ambiente = $request->validated();

        //guardar datos
        Ambiente::create($ambiente);

        //retornamos mensaje
        return response()->json([
            'message' => 'Ambiente guardado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['error' => 'Ambiente no encontrado'], 404);
        }

        return response()->json($ambiente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmbienteRequest $request, string $id)
    {
        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['error' => 'Ambiente no encontrado'], 404);
        }

        $ambiente_data = $request->validated();
        $ambiente->update($ambiente_data);
        return response()->json($ambiente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ambiente = Ambiente::find($id);

        if (!$ambiente) {
            return response()->json(['error' => 'Ambiente no encontrado'], 404);
        }

        $ambiente->delete();
        return response()->json(['message' => 'Ambiente eliminado correctamente']);
    }
}
