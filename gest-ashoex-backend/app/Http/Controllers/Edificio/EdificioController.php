<?php

namespace App\Http\Controllers\Edificio;

use App\Http\Controllers\Controller;
use App\Models\Edificio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $edificios = Edificio::all();

        return response()->json($edificios, 200);
    }

    private function validateEdificioData(Request $request) {
        return Validator::make($request->all(), [
            'nombre_edificio' => 'required|string',
            'geolocalizacion' => 'required|string',
        ], [
            'nombre_edificio.required' => 'Debe ingresar un nombre valido',
            'nombre_edificio.string' => 'El nombre debe ser correcto',
            'geolocalizacion.required' => 'La geolocalizacion es requerida',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->validateEdificioData($request);

            if ($validator->fails()) {
                return response()->json([
                    'message' => implode('.', $validator->errors()->all())
                ], 400);
            }

            $edificio = new Edificio();

            $edificio->nombre_edificio = $request->nombre_edificio;
            $edificio->geolocalizacion = $request->geolocalizacion;

            $edificio->save();

            return response()->json([
                'message' => 'Edificio creado correctamente'
            ], 201);
        }
        catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
