<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrera;
use App\Http\Requests\CrearCarreraRequest;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $carreras = Carrera::all();
        return response()->json($carreras, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearCarreraRequest $request)
    {
        $validated = $request->validated();
        $carrera = Carrera::create(['nombre' => $validated['nombre']]);

        return response()->json([
            'message' => 'Carrera creada exitosamente',
            'carrera' => $carrera,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carrera=Carrera::find($id);
        return response()->json($carrera,200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
