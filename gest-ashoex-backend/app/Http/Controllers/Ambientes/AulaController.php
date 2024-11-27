<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Aula;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreAulaRequest;
use App\Http\Requests\Ambientes\UpdateAulaRequest;

class AulaController extends Controller
{
    // Obtener todas las aulas con sus usos y facilidades
    /**
     * @OA\Get(
     *     path="/api/aulas",
     *     summary="Obtener todas las aulas con sus usos y facilidades",
     *     description="Retorna una lista de todas las aulas junto con sus usos y facilidades.",
     *     operationId="getAllAulas",
     *     tags={"Aulas"},
     *     @OA\Response(
     *         response=200,
     *         description="Éxito. Lista de aulas obtenida correctamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="numero_aula", type="string", example="A101"),
     *                 @OA\Property(property="capacidad", type="integer", example=40),
     *                 @OA\Property(property="habilitada", type="boolean", example=true),
     *                 @OA\Property(property="id_ubicacion", type="integer", example=2),
     *                 @OA\Property(
     *                     property="usos",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="nombre", type="string", example="Clases")
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="facilidades",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=1),
     *                         @OA\Property(property="descripcion", type="string", example="Proyector")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error interno del servidor")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $aulas = Aula::with('uso', 'facilidades')->get();
        return response()->json([
            'success' => true,
            'data' => $aulas,
            'error' => null,
            'message' => 'Lista de aulas recuperada exitosamente'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/aulas/{id}",
     *     summary="Obtener información de un aula específica",
     *     description="Retorna los detalles de un aula por su ID, incluyendo sus usos y facilidades.",
     *     operationId="getAulaById",
     *     tags={"Aulas"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del aula",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Éxito. Datos del aula obtenidos correctamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="numero_aula", type="string", example="A101"),
     *             @OA\Property(property="capacidad", type="integer", example=40),
     *             @OA\Property(property="habilitada", type="boolean", example=true),
     *             @OA\Property(property="id_ubicacion", type="integer", example=2),
     *             @OA\Property(
     *                 property="usos",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nombre", type="string", example="Clases")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="facilidades",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="descripcion", type="string", example="Proyector")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No encontrado. Aula no existe",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Aula no encontrada")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $aula = Aula::with('uso', 'facilidades')->find($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => null,
                'message' => 'Aula no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula recuperada exitosamente'
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/aulas",
     *     tags={"Aulas"},
     *     summary="Almacena una nueva aula en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"numero_aula", "id_ubicacion", "id_uso", "facilidades"},
     *             @OA\Property(property="numero_aula", type="string", maxLength=30, example="Aula 101"),
     *             @OA\Property(property="capacidad", type="integer", nullable=true, example=30),
     *             @OA\Property(property="habilitada", type="boolean", example=true),
     *             @OA\Property(property="id_ubicacion", type="integer", example=1),
     *             @OA\Property(property="id_uso", type="integer", example=2),
     *             @OA\Property(
     *                 property="facilidades",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Aula registrada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="numero_aula", type="string", example="Aula 101"),
     *                 @OA\Property(property="capacidad", type="integer", example=30),
     *                 @OA\Property(property="habilitada", type="boolean", example=true),
     *                 @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                 @OA\Property(property="id_uso", type="integer", example=2),
     *                 @OA\Property(property="facilidades", type="array", @OA\Items(type="integer", example=1))
     *             ),
     *             @OA\Property(property="error", type="array",
     *                  @OA\Items(), example={}),
     *             @OA\Property(property="message", type="string", example="Aula registrada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data",  type="array",@OA\Items(), example={}),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="El campo numero aula es obligatorio.")
     *                 ),
     *                 example={
     *                     {"status": "422", "detail": "El campo numero aula es obligatorio."},
     *                     {"status": "422", "detail": "El campo id ubicacion seleccionado no existe."},
     *                     {"status": "422", "detail": "El campo facilidades seleccionado no existe."}
     *                 }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     )
     * )
     */
    public function store(StoreAulaRequest $request)
    {
        $aula = Aula::create($request->validated());

        $aula->facilidades()->attach($request->facilidades);

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula registrada exitosamente'
        ], 201);
    }

    // Actualizar un aula existente
    /**
     * @OA\Put(
     *     path="/api/aulas/{id}",
     *     tags={"Aulas"},
     *     summary="Actualizar un aula existente",
     *     description="Actualiza un aula por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del aula",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="numero_aula", type="string", example="Aula 101"),
     *             @OA\Property(property="capacidad", type="integer", example="30"),
     *             @OA\Property(property="habilitada", type="boolean", example="true"),
     *             @OA\Property(property="id_ubicacion", type="integer", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aula actualizada",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_aula", type="integer", example="1"),
     *             @OA\Property(property="numero_aula", type="string", example="Aula 101"),
     *             @OA\Property(property="capacidad", type="integer", example="30"),
     *             @OA\Property(property="habilitada", type="boolean", example="true"),
     *             @OA\Property(property="id_ubicacion", type="integer", example="1"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aula no encontrada"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(UpdateAulaRequest $request, $id)
    {
        $aula = Aula::findOrFail($id);
        $aula->update($request->validated());

        if ($request->has('facilidades')) {
            $aula->facilidades()->sync($request->facilidades);
        }

        return response()->json([
            'success' => true,
            'data' => $aula,
            'error' => null,
            'message' => 'Aula actualizada exitosamente'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/aulas/{id}",
     *     tags={"Aulas"},
     *     summary="Elimina un aula por el ID proporcionado",
     *     description="Elimina el aula especificada por su ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del aula a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aula eliminada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(type="string"),  
     *                 example={}
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(type="string"),  
     *                 example={}
     *             ),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aula no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(type="string"),  
     *                 example={}
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(type="string", example="El aula no existe")
     *             ),
     *             @OA\Property(property="message", type="string", example="Operación fallida")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $aula = Aula::find($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => [],
                'error' => 'Aula no encontrada',
                'message' => 'Operación fallida'
            ], 404);
        }

        $aula->delete();

        return response()->json([
            'success' => true,
            'data' => [],
            'error' => [],
            'message' => 'Operación exitosa'
        ], 200);
    }
}
