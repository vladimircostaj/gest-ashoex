<?php

namespace App\Http\Controllers;

use App\Models\Facilidad;
use Illuminate\Http\Request;

class FacilidadController extends Controller
{
    // Obtener todas las facilidades
    public function index()
    {
        return Facilidad::all();
    }

    // Obtener una facilidad por su ID
    public function show($id)
    {
        return Facilidad::findOrFail($id);
    }

    // Crear una nueva facilidad
    /**
     * @OA\Post(
     *     path="/api/facilidades",
     *     tags={"Facilidades"},
     *     summary="Crear una nueva facilidad",
     *     description="Este endpoint permite crear una nueva facilidad en un aula específica.",
     *     operationId="crearFacilidad",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre_facilidad", "id_aula"},
     *             @OA\Property(
     *                 property="nombre_facilidad",
     *                 type="string",
     *                 description="Nombre de la facilidad",
     *                 example="Proyector"
     *             ),
     *             @OA\Property(
     *                 property="id_aula",
     *                 type="integer",
     *                 description="ID del aula asociada",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Facilidad creada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=5),
     *             @OA\Property(property="nombre_facilidad", type="string", example="Proyector"),
     *             @OA\Property(property="id_aula", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-30T12:34:56Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-30T12:34:56Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="nombre_facilidad",
     *                     type="array",
     *                     @OA\Items(type="string", example="El campo nombre_facilidad es obligatorio.")
     *                 ),
     *                 @OA\Property(
     *                     property="id_aula",
     *                     type="array",
     *                     @OA\Items(type="string", example="El campo id_aula no existe en la tabla de aulas.")
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
    public function store(Request $request)
    {
        $request->validate([
            'nombre_facilidad' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $facilidad = Facilidad::create($request->all());

        return response()->json($facilidad, 201);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_facilidad' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $facilidad = Facilidad::findOrFail($id);
        $facilidad->update($request->all());

        return response()->json($facilidad, 200);
    }

    // Eliminar una facilidad
    public function destroy($id)
    {
        $facilidad = Facilidad::findOrFail($id);
        $facilidad->delete();

        return response()->json(null, 204);
    }
}
