<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            [ 'name' => 'Edificio MEMI', 'latitude' => 0.0, 'longitude' => 0.0 ],
            [ 'name' => 'Edificio Elektro', 'latitude' => 0.0, 'longitude' => 0.0 ],
            [ 'name' => 'Edificio Academico 2', 'latitude' => 0.0, 'longitude' => 0.0 ],
        ];
    }

    private function validateBuildingData(Request $request) {
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ], [
            'name.required' => 'Debe ingresar un nombre valido',
            'name.string' => 'El nombre debe ser correcto',
            'latitude.required' => 'Debe ingresar la latitud',
            'latitude.numeric' => 'La latitud debe ser numerica',
            'longitude.required' => 'Debe ingresar la longitud',
            'longitude.numeric' => 'La longitud debe ser numerica',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->validateBuildingData($request);

            if ($validator->fails()) {
                return response()->json([
                    'message' => implode('.', $validator->errors()->all())
                ], 400);
            }

            $building = new Building();

            $building->name = $request->name;
            $building->latitude = $request->latitude;
            $building->longitude = $request->longitude;

            $building->save();

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
