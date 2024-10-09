<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/edificios",
     *     tags={"Edificios"},
     *     summary="Obtener lista de edificios",
     *     description="Devuelve una lista de todos los edificios",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de edificios",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Edificio"))
     *     )
     * )
     */
    public function index()
    {
        return Edificio::all();
    }

    /**
     * @OA\Post(
     *     path="/api/edificios",
     *     tags={"Edificios"},
     *     summary="Crear un nuevo edificio",
     *     description="Crea un nuevo edificio en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Edificio")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Edificio creado correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Edificio")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $edificio = Edificio::create($request->all());
        return response()->json($edificio, 201);
    }

    /**
     * @OA\Schema(
     *     schema="Edificio",
     *     type="object",
     *     title="Edificio",
     *     required={"nombre_edificio", "geolocalizacion"},
     *     properties={
     *         @OA\Property(property="id_edificio", type="integer", example=1),
     *         @OA\Property(property="nombre_edificio", type="string", example="Edificio Central"),
     *         @OA\Property(property="geolocalizacion", type="string", example="Latitud, Longitud")
     *     }
     * )
     */
}