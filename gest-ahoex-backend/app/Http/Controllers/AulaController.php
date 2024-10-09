<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Aula",
 *     type="object",
 *     title="Aula",
 *     required={"numero_aula", "capacidad", "habilitada", "id_ubicacion"},
 *     properties={
 *         @OA\Property(property="id_aula", type="integer", example=1),
 *         @OA\Property(property="numero_aula", type="string", example="A101"),
 *         @OA\Property(property="capacidad", type="integer", example=30),
 *         @OA\Property(property="habilitada", type="boolean", example=true),
 *         @OA\Property(property="id_ubicacion", type="integer", example=2)
 *     }
 * )
 */

class AulaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/aulas",
     *     tags={"Aulas"},
     *     summary="Obtener lista de aulas",
     *     description="Devuelve una lista de todas las aulas disponibles",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de aulas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Aula"))
     *     )
     * )
     */
    public function index()
    {
        return Aula::all();
    }

    /**
     * @OA\Post(
     *     path="/api/aulas",
     *     tags={"Aulas"},
     *     summary="Crear una nueva aula",
     *     description="Crea una nueva aula en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Aula")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Aula creada correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Aula")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $aula = Aula::create($request->all());
        return response()->json($aula, 201);
    }
}
