<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    // Obtener todos los edificios con sus ubicaciones
    /**
     * @OA\Get(
     *     path="/api/edificios",
     *     tags={"Edificios"},
     *     summary="Obtener todos los edificios con sus ubicaciones",
     *     description="Devuelve una lista de todos los edificios, incluyendo sus ubicaciones asociadas",
     *     operationId="obtenerEdificios",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de edificios obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id_edificio", type="integer", example=1),
     *                 @OA\Property(property="nombre_edificio", type="string", example="Edificio A"),
     *                 @OA\Property(property="geolocalizacion", type="string", example="Latitud: 19.4326, Longitud: -99.1332"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-30T12:34:56Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-30T12:34:56Z"),
     *                 @OA\Property(
     *                     property="ubicaciones",
     *                     type="array",
     *                     description="Lista de ubicaciones dentro del edificio",
     *                     @OA\Items(
     *                         @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                         @OA\Property(property="piso", type="integer", example=1),
     *                         @OA\Property(property="id_edificio", type="integer", example=1),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-30T12:34:56Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-30T12:34:56Z")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Error interno del servidor")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Edificio::with('ubicaciones')->get();
    }

    // Obtener un edificio por su ID, incluyendo las ubicaciones, aulas, usos y facilidades
    /**
     * @OA\Get(
     *     path="/api/edificios/{id}",
     *     tags={"Edificios"},
     *     summary="Obtener un edificio por su ID",
     *     description="Devuelve un edificio con sus ubicaciones, aulas, usos y facilidades",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del edificio",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Edificio encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_edificio", type="integer", example="1"),
     *             @OA\Property(property="nombre_edificio", type="string", example="Edificio A"),
     *             @OA\Property(property="geolocalizacion", type="string", example="Latitud: 19.4326, Longitud: -99.1332"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time"),
     *             @OA\Property(property="ubicaciones", type="array", @OA\Items(
     *                @OA\Property(property="id_ubicacion", type="integer", example="1"),
     *                @OA\Property(property="piso", type="integer", example="1"),
     *                @OA\Property(property="id_edificio", type="integer", example="1"),
     *                @OA\Property(property="created_at", type="string", format="date-time"),
     *                @OA\Property(property="updated_at", type="string", format="date-time"),
     *                @OA\Property(property="aulas", type="array", @OA\Items(
     *                  @OA\Property(property="id_aula", type="integer", example="1"),
     *                  @OA\Property(property="nombre_aula", type="string", example="Aula 101"),
     *                  @OA\Property(property="capacidad", type="integer", example="30"),
     *                  @OA\Property(property="id_ubicacion", type="integer", example="1"),
     *                  @OA\Property(property="created_at", type="string", format="date-time"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time"),
     *                  @OA\Property(property="usos", type="array", @OA\Items(
     *                      @OA\Property(property="id_uso", type="integer", example="1"),
     *                      @OA\Property(property="nombre_uso", type="string", example="Clase"),
     *                      @OA\Property(property="id_aula", type="integer", example="1"),
     *                      @OA\Property(property="created_at", type="string", format="date-time"),
     *                      @OA\Property(property="updated_at", type="string", format="date-time")
     *                  )),
     *                  @OA\Property(property="facilidades", type="array", @OA\Items(
     *                  @OA\Property(property="id_facilidad", type="integer", example="1"),
     *                  @OA\Property(property="nombre_facilidad", type="string", example="Proyector"),
     *                  @OA\Property(property="id_aula", type="integer", example="1"),
     *                  @OA\Property(property="created_at", type="string", format="date-time"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time")
     *                  ))
     *                ))
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Edificio no encontrado"
     *     )
     * )
     */
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
