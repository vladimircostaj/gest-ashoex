<?php

namespace App\Http\Controllers;

use App\Models\Uso;
use Illuminate\Http\Request;

class UsoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/usos",
     *     tags={"Usos"},
     *     summary="Obtener lista de usos",
     *     description="Devuelve una lista de todos los usos",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Uso"))
     *     )
     * )
     */
    public function index()
    {
        return Uso::all();
    }

    /**
     * @OA\Schema(
     *     schema="Uso",
     *     type="object",
     *     title="Uso",
     *     required={"tipo_uso", "id_aula"},
     *     properties={
     *         @OA\Property(property="id_uso", type="integer", example=1),
     *         @OA\Property(property="tipo_uso", type="string", example="Clase"),
     *         @OA\Property(property="id_aula", type="integer", example=2)
     *     }
     * )
     */
}