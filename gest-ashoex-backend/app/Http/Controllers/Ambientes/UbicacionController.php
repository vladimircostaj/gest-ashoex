<?php

namespace App\Http\Controllers\Ambientes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreUbicacionRequest;
use App\Http\Requests\Ambientes\UpdateUbicacionRequest;
use App\Models\Ambientes\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    // Obtener todas las ubicaciones con sus aulas
    public function index()
    {
        $ubicaciones = Ubicacion::with('aulas')->get();
        return response()->json([
            'success' => true,
            'data' => $ubicaciones,
            'error' => null,
            'message' => 'Lista de ubicaciones recuperada exitosamente'
        ]);
    }

    // Obtener una ubicación por su ID, incluyendo las aulas, usos y facilidades
    /**
     * @OA\Get(
     *     path="/api/ubicaciones/{id}",
     *     tags={"Ubicaciones"},
     *     summary="Obtiene los detalles de una ubicación por su ID, incluyendo aulas, usos y facilidades",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de la ubicación"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                 @OA\Property(property="piso", type="integer", example=3),
     *                 @OA\Property(property="id_edificio", type="integer", example=1),
     *                 @OA\Property(property="aulas", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id_aula", type="integer", example=11),
     *                         @OA\Property(property="numero_aula", type="string", example="INF123"),
     *                         @OA\Property(property="capacidad", type="integer", example=10),
     *                         @OA\Property(property="habilitada", type="boolean", example=true),
     *                         @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                         @OA\Property(property="id_uso", type="integer", example=1),
     *                         @OA\Property(property="uso", type="object",
     *                             @OA\Property(property="id_uso", type="integer", example=1),
     *                             @OA\Property(property="tipo_uso", type="string", example="Clases")
     *                         ),
     *                         @OA\Property(property="facilidades", type="array",
     *                             @OA\Items(
     *                                 type="object",
     *                                 @OA\Property(property="id_facilidad", type="integer", example=1),
     *                                 @OA\Property(property="nombre_facilidad", type="string", example="Pizarra"),
     *                                 @OA\Property(property="pivot", type="object",
     *                                     @OA\Property(property="id_aula", type="integer", example=11),
     *                                     @OA\Property(property="id_facilidad", type="integer", example=1)
     *                                 )
     *                             )
     *                         )
     *                     )
     *                 )
     *             ),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Ubicación recuperada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ubicación no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="string", example="Ubicación no encontrada"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $ubicacion = Ubicacion::with('aulas.uso', 'aulas.facilidades')->findOrFail($id);

        if (!$ubicacion) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Ubicación no encontrada',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación recuperada exitosamente'
        ]);
    }

    // Crear una nueva ubicación
        /**
     * @OA\Post(
     *     path="/api/ubicaciones",
     *     tags={"Ubicaciones"},
     *     summary="Almacena una nueva ubicación en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"piso", "id_edificio"},
     *             @OA\Property(property="piso", type="integer", example=3, description="Número de piso de la ubicación"),
     *             @OA\Property(property="id_edificio", type="integer", example=1, description="ID del edificio donde se encuentra la ubicación")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ubicación creada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="piso", type="integer", example=3),
     *                 @OA\Property(property="id_edificio", type="integer", example=1),

     *                 @OA\Property(property="id_ubicacion", type="integer", example=9)
     *             ),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Ubicación registrada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="El campo piso es obligatorio.")
     *                 ), example={
     *                         {
     *                             "status": 422,
     *                             "detail": "El campo piso es obligatorio."
     *                         },
     *                         {
     *                             "status": 422,
     *                             "detail": "El campo id edificio es obligatorio."
     *                         }
     *                     }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     )
     * )
     */

    public function store(StoreUbicacionRequest $request)
    {
        $ubicacion = Ubicacion::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación registrada exitosamente'
        ], 201);
    }

    // Actualizar una ubicación existente
        /**
     * @OA\Put(
     *     path="/api/ubicaciones/{id}",
     *     tags={"Ubicaciones"},
     *     summary="Actualiza una ubicación existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de la ubicación a actualizar"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"piso", "id_edificio"},
     *             @OA\Property(property="piso", type="integer", example=3, description="Número de piso de la ubicación"),
     *             @OA\Property(property="id_edificio", type="integer", example=1, description="ID del edificio donde se encuentra la ubicación")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ubicación actualizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                 @OA\Property(property="piso", type="integer", example=3),
     *                 @OA\Property(property="id_edificio", type="integer", example=1)
     *             ),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Ubicación actualizada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada inválidos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *              @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="El campo id_ubicacion es obligatorio.")
     *                 ), example={
     *                     {
     *                         "status": 422,
     *                         "detail": "El campo piso es obligatorio."
     *                     },
     *                     {
     *                         "status": 422,
     *                         "detail": "El campo id edificio es obligatorio"
     *                     },
     *                 }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     )
     * )
     */

    public function update(UpdateUbicacionRequest $request, $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $ubicacion,
            'error' => null,
            'message' => 'Ubicación actualizada exitosamente'
        ]);
    }

    // Eliminar una ubicación
        /**
     * @OA\Delete(
     *     path="/api/ubicaciones/{id}",
     *     tags={"Ubicaciones"},
     *     summary="Elimina una ubicación por el ID proporcionado",
     *     description="Elimina la ubicación de la base de datos según el ID dado",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la ubicación a eliminar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ubicación eliminada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                  @OA\Items(type="object"),
     *                  example="null"
     *              ),
     *             @OA\Property(property="error", type="array",
     *                  @OA\Items(type="object"),
     *                  example="null"
     *              ),
     *             @OA\Property(property="message", type="string", example="Ubicación eliminada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ubicación no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="string", example="Ubicación no encontrada"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */

    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Ubicación no encontrada',
                'message' => ''
            ], 404);
        }

        $ubicacion->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Ubicación eliminada exitosamente'
        ], 204);
    }
}

