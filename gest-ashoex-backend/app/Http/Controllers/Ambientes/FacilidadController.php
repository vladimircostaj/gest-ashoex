<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Facilidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreFacilidadRequest;
use App\Http\Requests\Ambientes\UpdateFacilidadRequest;

class FacilidadController extends Controller
{
    // Obtener todas las facilidades
    /**
     * @OA\Get(
     *     path="/api/facilidades",
     *     tags={"Facilidades"},
     *     summary="Lista todas las facilidades disponibles",
     *     description="Devuelve una lista de todas las facilidades almacenadas en la base de datos.",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de facilidades recuperada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre_facilidad", type="string", example="Televisor")
     *             )),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Lista de facilidades recuperada exitosamente")
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
        $facilidades = Facilidad::all();
        return response()->json([
            'success' => true,
            'data' => $facilidades,
            'error' => null,
            'message' => 'Lista de facilidades recuperada exitosamente'
        ]);
    }

    // Obtener una facilidad por su ID
    /**
     * @OA\Get(
     *     path="/api/facilidades/{id}",
     *     tags={"Facilidades"},
     *     summary="Obtiene una facilidad específica",
     *     description="Devuelve la información de una facilidad utilizando su ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la facilidad que se desea recuperar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Facilidad recuperada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre_facilidad", type="string", example="Televisor")
     *             ),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Facilidad recuperada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Facilidad no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="string", example="Facilidad no encontrada"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $facilidad = Facilidad::find($id);

        if (!$facilidad) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Facilidad no encontrada',
                'message' => ''
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $facilidad,
            'error' => null,
            'message' => 'Facilidad recuperada exitosamente'
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/facilidades",
     *     tags={"Facilidades"},
     *     summary="Almacena una nueva facilidad en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"nombre_facilidad"},
     *             @OA\Property(property="nombre_facilidad", type="string", example="Televisor"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Facilidad registrada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="nombre_facilidad", type="string", example="Televisor"),
     *                 @OA\Property(property="id_facilidad", type="integer", example=10),
     *             ),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Facilidad registrada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example={} ),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="El campo nombre_facilidad es obligatorio.")
     *                 ), example={
     *                     {
     *                         "status": 422,
     *                         "detail": "El campo nombre facilidad es obligatorio."
     *                     },
     *                     {
     *                         "status": 422,
     *                         "detail": "El campo aula seleccionada no existe."
     *                     },
     * {
     *                         "status": 422,
     *                         "detail": "El campo aula es obligatorio."
     *                     },
     * {
     *                         "status": 422,
     *                         "detail": "El valor del campo nombre facilidad ya está en uso."
     *                     }
     *                 }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     ),
     * )
     */

    public function store(StoreFacilidadRequest $request)
    {
        $facilidad = Facilidad::create($request->validated());

        if ($request->has('aulas')) {
            $facilidad->aulas()->sync($request->aulas);
        }

        return response()->json([
            'success' => true,
            'data' => $facilidad,
            'error' => null,
            'message' => 'Facilidad registrada exitosamente'
        ], 201);
    }

    // Actualizar una facilidad existente
    /**
     * @OA\Put(
     *     path="/api/facilidades/{id}",
     *     tags={"Facilidades"},
     *     summary="Actualizar facilidad",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la facilidad",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nombre_facilidad",
     *                     type="string",
     *                     description="Nombre de la facilidad",
     *                     example="Proyector"
     *                 ),
     *                 @OA\Property(
     *                     property="id_aula",
     *                     type="integer",
     *                     description="ID del aula",
     *                     example="1"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Facilidad actualizada correctamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Facilidad no encontrada"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(UpdateFacilidadRequest $request, $id)
{
    $facilidad = Facilidad::find($id);

    // Si no se encuentra, devolver un error 404
    if (!$facilidad) {
        return response()->json([
            'success' => false,
            'data' => null,
            'error' => ['Facilidad no encontrada'],
            'message' => 'No se pudo actualizar la facilidad'
        ], 404);
    }

    // Actualiza la facilidad si se encuentra
    $facilidad->update($request->validated());

    if ($request->has('aulas')) {
        $facilidad->aulas()->sync($request->aulas);
    }

    return response()->json([
        'success' => true,
        'data' => $facilidad,
        'error' => null,
        'message' => 'Facilidad actualizada exitosamente'
    ]);
}


    /**
     * @OA\Delete(
     *     path="/api/facilidades/{id}",
     *     tags={"Facilidades"},
     *     summary="Elimina una facilidad por su ID",
     *     description="Elimina una facilidad existente y devuelve el resultado de la operación",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la facilidad",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Facilidad eliminada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="null", example=null),
     *             @OA\Property(property="message", type="string", example="Facilidad eliminada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Facilidad no encontrada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(property="error", type="string", example="Facilidad no encontrada"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $facilidad = Facilidad::find($id);

        if (!$facilidad) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Facilidad no encontrada',
                'message' => ''
            ], 404);
        }

        $facilidad->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Facilidad eliminada exitosamente'
        ], 204);
    }
}
