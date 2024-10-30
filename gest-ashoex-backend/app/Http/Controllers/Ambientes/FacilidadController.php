<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Facilidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreFacilidadRequest;
use App\Http\Requests\Ambientes\UpdateFacilidadRequest;

class FacilidadController extends Controller
{
    // Obtener todas las facilidades
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
 *     summary="Obtiene una facilidad específica",
 *     description="Retorna los detalles de una facilidad dado su ID",
 *     tags={"Facilidades"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la facilidad",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles de la facilidad",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="nombre_facilidad", type="string", example="Pizarra Inteligente"),
 *                 @OA\Property(property="descripcion", type="string", example="Pizarra interactiva para presentaciones")
 *             ),
 *             @OA\Property(property="error", type="null"),
 *             @OA\Property(property="message", type="string", example="Facilidad obtenida exitosamente")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Facilidad no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="data", type="null"),
 *             @OA\Property(property="error", type="string", example="Facilidad no encontrada"),
 *             @OA\Property(property="message", type="string", example="")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error en la solicitud"
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

    // Crear una nueva facilidad
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


    // Eliminar una facilidad
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
        ]);
    }
}

