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

    // Obtener un aula por su ID, incluyendo sus usos y facilidades
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
