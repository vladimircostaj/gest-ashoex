<?php

namespace App\Http\Controllers;
use App\Http\Requests\GrupoRequest;
use Illuminate\Database\QueryException;
use App\Models\Grupo;
use Illuminate\Http\Response;


class GrupoController extends Controller{
    /**
     * @OA\Get(
     *     path="/api/grupo",
     *     tags={"Grupos"},
     *     summary="Obtener lista de grupos",
     *     description="Este endpoint retorna una lista de grupos.",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de grupos obtenida con éxito",
     *     )
     * )
     */
    public function index()
    {
            $grupos = Grupo::all();
        return response()->json($grupos,200);

    }
    public function store(GrupoRequest $request)
    {
        try {
            // Crear un nuevo grupo con los datos validados
            $grupo = new Grupo($request->validated());
            $grupo->save();

            // Responder con el grupo creado y código 201 (Creado)
            return response()->json($grupo, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            // Código SQL 23000 se refiere a violaciones de integridad como duplicados
            if ($e->getCode() === '23000') {
                return response()->json([
                    'message' => 'Error: Ya existe un grupo con este número para la materia seleccionada.',
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Manejo de otros errores generales
            return response()->json([
                'message' => 'Error al crear el grupo.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/grupo/{id}",
     *     tags={"Grupos"},
     *     summary="Obtiene los detalles de una grupo por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID de la grupo"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="materia_id", type="integer", example="1"),
     *                 @OA\Property(property="nro_grupo", type="number", example=1)
     *             ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example={}),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="El grupo  no existe",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example={}),
     *             @OA\Property(property="error", type="array", 
     *                 @OA\Items(type="string", example="Grupo no encontrado")),
     *             @OA\Property(property="message", type="string", example="Operación fallida")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en el servidor interno",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example={}),
     *             @OA\Property(property="error", type="array", 
     *                 @OA\Items(type="string", example="Ocurrió un error inesperado")),
     *             @OA\Property(property="message", type="string", example="Operación fallida")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $grupo = Grupo::find($id);

        if (!$grupo) {
            return response()->json([
                'success' => false,
                'error' => 'Grupo no encontrado',
                'message' => 'Operacion fallida',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $grupo,
            'message' => 'Operacion exitosa'
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(GrupoRequest $request, string $id)
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


    /**
 * @OA\Delete(
 *     path="/api/grupo/{id}",
 *     summary="Eliminar un grupo",
 *     description="Elimina un grupo especificado por su ID",
 *     tags={"Grupos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID del grupo a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="El grupo ha sido eliminado con éxito",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="boolean",
 *                 example=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Grupo no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=false
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Grupo no encontrado"
 *             )
 *         )
 *     )
 * )
 */
public function destroy(string $id)
{
    $grupo = Grupo::find($id);
    if ($grupo) {
        $grupo->delete();
        return response()->json([
            'success' => true,
            'data' => true,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Grupo no encontrado'
        ], 404);
    }
 }
}
