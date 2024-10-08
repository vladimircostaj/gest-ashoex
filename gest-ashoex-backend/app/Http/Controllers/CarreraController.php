<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrera;
use App\Http\Requests\CrearCarreraRequest;
use Illuminate\Foundation\Configuration\Exceptions;

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
        if($carrera){
            
            return response()->json([
                "success"=> true,
                "data"=> [],
                "error"=> [],
                "message"=> "Operacion exitosa"
            ],200);  
        }else{
            return response()->json([
                "success"=> false,
                "data"=> [],
                "error"=> ["La carrera no existe"],
                "message"=> "Operacion fallida"
            ],404);  
        }

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
        $carrera = Carrera::find($id);
        if ($carrera){
            $carrera->delete();
            return response()->json([
                'success'=>true,
                'data'=>$carrera
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'data'=>$carrera
            ],404);
        }
    }
}
