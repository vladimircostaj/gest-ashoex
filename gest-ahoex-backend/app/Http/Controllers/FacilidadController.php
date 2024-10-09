<?php

namespace App\Http\Controllers;

use App\Models\Facilidad;
use Illuminate\Http\Request;

class FacilidadController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/facilidades",
     *     tags={"Facilidades"},
     *     summary="Obtener lista de facilidades",
     *     description="Devuelve una lista de todas las facilidades",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de facilidades",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Facilidad"))
     *     )
     * )
     */
    public function index()
    {
        return Facilidad::all();
    }

    /**
     * @OA\Schema(
     *     schema="Facilidad",
     *     type="object",
     *     title="Facilidad",
     *     required={"nombre_facilidad", "id_aula"},
     *     properties={
     *         @OA\Property(property="id_facilidad", type="integer", example=1),
     *         @OA\Property(property="nombre_facilidad", type="string", example="Proyector"),
     *         @OA\Property(property="id_aula", type="integer", example=2)
     *     }
     * )
     */
}