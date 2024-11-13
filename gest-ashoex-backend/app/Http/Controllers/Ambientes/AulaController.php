<?php

namespace App\Http\Controllers\Ambientes;

use App\Models\Ambientes\Aula;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreAulaRequest;
use App\Http\Requests\Ambientes\UpdateAulaRequest;

class AulaController extends Controller
{
    // Obtener todas las aulas con sus usos y facilidades
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

    // Crear un nuevo aula
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
    public function update(UpdateAulaRequest $request, $id)
    {
        $aula = Aula::findOrFail($id);
        $aula -> update($request->validated());

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

    // Eliminar un aula
    public function destroy($id)
    {
        $aula = Aula::find($id);

        if (!$aula) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Aula no encontrada',
                'message' => ''
            ], 404);
        }

        $aula->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Aula eliminada exitosamente'
        ], 204);

    }
}
