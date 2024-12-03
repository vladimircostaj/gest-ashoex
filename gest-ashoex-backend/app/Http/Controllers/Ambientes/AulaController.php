<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Aula;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreAulaRequest;
use App\Http\Requests\Ambientes\UpdateAulaRequest;

class AulaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/aulas",
     *     summary="Obtener todas las aulas con sus usos y facilidades",
     *     description="Retorna una lista de todas las aulas junto con sus usos y facilidades.",
     *     operationId="getAllAulas",
     *     tags={"Aulas"},
     *     @OA\Response(
     *         response=200,
     *         description="Éxito. Lista de aulas obtenida correctamente.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id_aula", type="integer", example=1),
     *                     @OA\Property(property="numero_aula", type="string", example="693 A"),
     *                     @OA\Property(property="capacidad", type="integer", example=100),
     *                     @OA\Property(property="habilitada", type="boolean", example=true),
     *                     @OA\Property(property="id_ubicacion", type="integer", example=1),
     *                     @OA\Property(
     *                         property="usos",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id_uso", type="integer", example=1),
     *                             @OA\Property(property="tipo_uso", type="string", example="Clases"),
     *                             @OA\Property(
     *                                 property="pivot",
     *                                 type="object",
     *                                 @OA\Property(property="id_aula", type="integer", example=1),
     *                                 @OA\Property(property="id_uso", type="integer", example=1)
     *                             )
     *                         )
     *                     ),
     *                     @OA\Property(
     *                         property="facilidades",
     *                         type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id_facilidad", type="integer", example=1),
     *                             @OA\Property(property="nombre_facilidad", type="string", example="Pizarra"),
     *                             @OA\Property(
     *                                 property="pivot",
     *                                 type="object",
     *                                 @OA\Property(property="id_aula", type="integer", example=1),
     *                                 @OA\Property(property="id_facilidad", type="integer", example=1)
     *                             )
     *                         )
     *                     )
     *                 )
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
     *         response=500,
     *         description="Error interno del servidor.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Error interno del servidor"),
     *             @OA\Property(property="message", type="string", example="Se produjo un error al recuperar las aulas")
     *         )
     *     )
     * )
     */

    public function index()
    {
        $aulas = Aula::with('usos', 'facilidades')->get();
        return response()->json([
            'success' => true,
            'data' => $aulas,
            'error' => [],
            'message' => 'Operación exitosa'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/aulas/{id}",
     *     summary="Obtener detalles de un aula específica",
     *     description="Obtiene información detallada de un aula específica por su ID.",
     *     operationId="getAula",
     *     tags={"Aulas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del aula",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles del aula recuperados exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"), example={
     *                 {"id_aula": 1, "numero_aula": "Aula 101", "capacidad": 40, "habilitada": true, "id_ubicacion": 1}
     *             }),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aula no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "No se encontró el aula con el ID proporcionado"
     *             }),
     *             @OA\Property(property="message", type="string", example="Aula no encontrada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "Error interno del servidor"
     *             }),
     *             @OA\Property(property="message", type="string", example="Se produjo un error al obtener los detalles del aula")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $aula = Aula::with('usos', 'facilidades')->find($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => [],
                "error" => ["Aula no encontrada"],
                "message" => "Error"
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [[
                'id_aula' => $aula->id_aula,
                'numero_aula' => $aula->numero_aula,
                'capacidad' => $aula->capacidad,
                'habilitada' => $aula->habilitada,
                'id_ubicacion' => $aula->id_ubicacion

            ]],
            'error' => [],
            'message' => 'Operación exitosa'
        ]);
    }



    /**
     * @OA\Post(
     *     path="/api/aulas",
     *     summary="Registrar una nueva aula",
     *     description="Crea una nueva aula con sus usos y facilidades asociadas.",
     *     operationId="storeAula",
     *     tags={"Aulas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"numero_aula", "capacidad", "habilitada", "id_ubicacion", "usos", "facilidades"},
     *             @OA\Property(property="numero_aula", type="string", example="Aula 101"),
     *             @OA\Property(property="capacidad", type="integer", example=30),
     *             @OA\Property(property="habilitada", type="boolean", example=true),
     *             @OA\Property(property="id_ubicacion", type="integer", example=1),
     *             @OA\Property(
     *                 property="usos",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             ),
     *             @OA\Property(
     *                 property="facilidades",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Aula creada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"), example={
     *                 {"id_aula": 5, "numero_aula": "Aula 101", "capacidad": 40, "habilitada": true, "id_ubicacion": 1}
     *             }),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Errores de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="integer", example=422),
     *                     @OA\Property(property="detail", type="string", example="El número del aula es obligatorio.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(type="string", example={"Error interno del servidor"})
     *             ),
     *             @OA\Property(property="message", type="string", example="Se produjo un error al registrar el aula")
     *         )
     *     )
     * )
     */

    public function store(StoreAulaRequest $request)
    {
        $aula = Aula::create($request->validated());

        $aula->facilidades()->attach($request->facilidades);
        $aula->usos()->attach($request->usos);

        return response()->json([
            'success' => true,
            'data' => [$aula],
            'error' => [],
            'message' => 'Operación exitosa'
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/aulas/{id}",
     *     summary="Actualizar una aula existente",
     *     description="Actualiza los datos de una aula existente, incluyendo sus facilidades y usos asociados.",
     *     operationId="updateAula",
     *     tags={"Aulas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la aula a actualizar",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"numero_aula", "capacidad"},
     *             @OA\Property(property="numero_aula", type="string", example="Aula 202"),
     *             @OA\Property(property="capacidad", type="integer", example=50),
     *             @OA\Property(property="habilitada", type="boolean", example=true),
     *             @OA\Property(property="id_ubicacion", type="integer", example=2),
     *             @OA\Property(
     *                 property="usos",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             ),
     *             @OA\Property(
     *                 property="facilidades",
     *                 type="array",
     *                 @OA\Items(type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aula actualizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"), example={
     *                 {"id_aula": 1, "numero_aula": "Aula 202", "capacidad": 50, "habilitada": true, "id_ubicacion": 2}
     *             }),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Errores de validación.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="integer", example=422),
     *                     @OA\Property(property="detail", type="string", example="El número del aula es obligatorio.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aula no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "No se encontró el aula con el ID especificado."
     *             }),
     *             @OA\Property(property="message", type="string", example="Aula no encontrada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "Error interno del servidor"
     *             }),
     *             @OA\Property(property="message", type="string", example="Se produjo un error al actualizar el aula")
     *         )
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

        if ($request->has('usos')) {
            $aula->usos()->sync($request->usos);
        }


        return response()->json([
            'success' => true,
            'data' => [$aula],
            'error' => [],
            'message' => 'Operación exitosa'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/aulas/{id}",
     *     summary="Eliminar un aula existente",
     *     description="Elimina un aula especificada por su ID.",
     *     operationId="deleteAula",
     *     tags={"Aulas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del aula a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Aula eliminada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Aula no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "El aula no existe"
     *             }),
     *             @OA\Property(property="message", type="string", example="Aula no encontrada")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(type="string"), example={} ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={
     *                 "Error interno del servidor"
     *             }),
     *             @OA\Property(property="message", type="string", example="Se produjo un error al eliminar el aula")
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
                'message' => 'Error'
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
