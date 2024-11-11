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
        $edificio= Edificio::with('ubicaciones.aulas.uso', 'ubicaciones.aulas.facilidades')->findOrFail($id);
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
        ], 204);
    }
}
