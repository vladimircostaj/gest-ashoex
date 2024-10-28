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

