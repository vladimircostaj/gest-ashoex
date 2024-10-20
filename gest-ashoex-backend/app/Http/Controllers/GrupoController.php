<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::all();
       return response()->json($grupos,200);
    }
/**
     * @OA\Post(
     *     path="/api/grupo",
     *     tags={"Grupos"},
     *     summary="Almacena un nuevo grupo en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"materia_id","nro_grupo"},
     *             @OA\Property(property="materia_id", type="number", example=10),
     *             @OA\Property(property="nro_grupo", type="number", example=10)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Grupo creado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="materia_id", type="number", example="10"),
     *                     @OA\Property(property="nro_grupo", type="number", example=10)
     *                 )
     *             ),
     *             @OA\Property(property="error", type="array", 
     *                  @OA\Items(), example={}),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",@OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="code", type="string", example="400"),
     *                     @OA\Property(property="detail", type="string", example="El campo 'materia_id' es requerido.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error"),
     *         )
     *     ),
     *   @OA\Response(
     *         response=409,
     *         description="Error de congruencia",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",@OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="code", type="string", example="409"),
     *                     @OA\Property(property="detail", type="string", example="materia con el mismo grupo ya existe.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en la conexión a la base de datos"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'materia_id' =>'required|exists:materias,id',
            'nro_grupo' => 'required|integer|min:1',
        ]);

        $existingGrupo = Grupo::where('materia_id', $datos ['materia_id'])
                          ->where('nro_grupo', $datos ['nro_grupo'])
                          ->first();

    if ($existingGrupo) {
        return response()->json([
            'message' => 'Existe un grupo con la misma materia y numero de grupo.'
        ], 409);
    }
        $grupo = new Grupo($datos);
        $grupo->save();
        return response()->json($grupo,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grupo = Grupo::find($id);
        return response()->json($grupo,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $grupo = Grupo::find($id);
    if (!$grupo) {
        return response()->json(['error' => 'Grupo no encontrado'], 404);
    }

    $grupo->id_materia = $request->id_materia;
    $grupo->nro_grupo = $request->nro_grupo;
    $grupo->save();

    return response()->json([
        'success' => true,
        'data' => $grupo
    ], 200);

    }


    public function destroy(string $id)
    {
        $grupo = Grupo::find($id)->delete();
        return response()->json([
            'success'=>true,
            'data'=> $grupo
        ],200);
    }
}
