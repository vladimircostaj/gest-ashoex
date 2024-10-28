<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    // Obtener todas las aulas con sus usos y facilidades
    public function index()
    {
        return Aula::with('usos', 'facilidades')->get();
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
        return Aula::with('usos', 'facilidades')->findOrFail($id);
    }


    // Crear un nuevo aula
    public function store(Request $request)
    {
        $request->validate([
            'numero_aula' => 'required|string|max:10',
            'capacidad' => 'nullable|integer',
            'habilitada' => 'boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        $aula = Aula::create($request->all());

        return response()->json($aula, 201);
    }

    // Actualizar un aula existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'numero_aula' => 'required|string|max:10',
            'capacidad' => 'nullable|integer',
            'habilitada' => 'boolean',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        $aula = Aula::findOrFail($id);
        $aula->update($request->all());

        return response()->json($aula, 200);
    }

    // Eliminar un aula
    public function destroy($id)
    {
        $aula = Aula::findOrFail($id);
        $aula->delete();

        return response()->json(null, 204);
    }
}
