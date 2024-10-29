<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Edificio;
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
        /**
     * @OA\Post(
     *     path="/api/edificios",
     *     summary="Crear un nuevo edificio",
     *     description="Crea un edificio con el nombre y la geolocalización proporcionados.",
     *     operationId="createEdificio",
     *     tags={"Edificios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_edificio"},
     *             @OA\Property(property="nombre_edificio", type="string", example="Edificio Central"),
     *             @OA\Property(property="geolocalizacion", type="string", example="-19.57347,-65.75537")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Éxito. Edificio creado correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nombre_edificio", type="string", example="Edificio Central"),
     *             @OA\Property(property="geolocalizacion", type="string", example="-19.57347,-65.75537"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-28T12:34:56Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-28T12:34:56Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación. Faltan datos o no son válidos",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="El nombre del edificio es obligatorio.")
     *         )
     *     )
     * )
     */
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
