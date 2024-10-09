<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/ubicaciones",
     *     tags={"Ubicaciones"},
     *     summary="Obtener lista de ubicaciones",
     *     description="Devuelve una lista de todas las ubicaciones",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de ubicaciones",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Ubicacion"))
     *     )
     * )
     */
    public function index()
    {
        return Ubicacion::all();
    }

    /**
     * @OA\Schema(
     *     schema="Ubicacion",
     *     type="object",
     *     title="Ubicacion",
     *     required={"piso", "id_edificio"},
     *     properties={
     *         @OA\Property(property="id_ubicacion", type="integer", example=1),
     *         @OA\Property(property="piso", type="integer", example=2),
     *         @OA\Property(property="id_edificio", type="integer", example=1)
     *     }
     * )
     */
}