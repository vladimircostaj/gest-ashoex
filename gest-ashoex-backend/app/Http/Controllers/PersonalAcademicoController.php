<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    JsonResponse
};

use App\Models\PersonalAcademico;

class PersonalAcademicoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/personal-academicos/{id}",
     *     tags={"Personal Académico"},
     *     summary="Obtiene la información de un personal académico por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personal académico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/PersonalAcademico")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado"
     *     )
     * )
     */
    public function index(int $id): JsonResponse
    {
        try {
            $personalAcademico = PersonalAcademico::find($id);
            return response()->json(
                $personalAcademico,
                (
                    !$personalAcademico?
                    404:
                    200
                )
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server error D:',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     *     path="/api/personal-academicos/{id}/dar-baja",
     *     tags={"Personal Académico"},
     *     summary="Dar de baja a un personal académico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personal académico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Baja exitosa",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="string", example="Se dio de baja correctamente al personal academico: Juan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado"
     *     )
     * )
     */
    public function darDeBaja($id): JsonResponse
    {
        try {
            // Buscar el personal académico por ID
            $personalAcademico = PersonalAcademico::find($id);

            if (!$personalAcademico) {
                return response()->json([
                    'data' => 'El personal académico seleccionado no existe.'
                ], 404);
            }

            // Llamar al método darBaja
            if ($personalAcademico->darBaja()) {
                return response()->json([
                    'data' => 'Se dio de baja correctamente al personal académico: '.$personalAcademico->nombre
                ], 200);
            } else {
                return response()->json([
                    'data' => 'El personal académico: '.$personalAcademico->nombre.' ya fue dado de baja anteriormente.'
                ], 400); // Cambiar a un código adecuado si ya está dado de baja
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en el servidor.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/registrar-personal-academico",
     *     tags={"Personal Académico"},
     *     summary="Registrar un nuevo personal académico",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "email", "telefono", "estado", "tipo_personal_id"},
     *             @OA\Property(property="nombre", type="string", example="Juan Pérez"),
     *             @OA\Property(property="email", type="string", example="juan.perez@example.com"),
     *             @OA\Property(property="telefono", type="string", example="+591123456789"),
     *             @OA\Property(property="estado", type="string", example="ACTIVO"),
     *             @OA\Property(property="tipo_personal_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Personal académico registrado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/PersonalAcademico")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function registrar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:personal_academicos,email',
            'telefono' => 'required|string|max:20',
            'estado' => 'required|string|in:ACTIVO,DESPEDIDO', // Reemplaza por los valores permitidos
            'tipo_personal_id' => 'required|integer|exists:tipo_personals,id',
        ]);

        $personalAcademico = PersonalAcademico::create($validated);

        return response()->json([
            'message' => 'Personal académico registrado exitosamente',
            'personalAcademico' => $personalAcademico
        ], 201);
    }


    /**
     * @OA\Get(
     *     path="/api/personal/{id}/informacion",
     *     tags={"Personal Académico"},
     *     summary="Mostrar la información de un personal académico por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personal académico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Información del personal académico obtenida exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/PersonalAcademico")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        // Buscar el registro de PersonalAcademico por ID
        $personalAcademico = PersonalAcademico::with('tipoPersonal')->find($id);
        // Verificar si existe
        if (!$personalAcademico) {
            return response()->json(['message' => 'Personal académico no encontrado'], 404);
        }

        // Retornar los datos del personal académico
        return response()->json($personalAcademico, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/personal-academico/{id}",
     *     tags={"Personal Académico"},
     *     summary="Actualizar la información de un personal académico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del personal académico",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "telefono", "estado", "tipo_personal_id"},
     *             @OA\Property(property="name", type="string", example="Juan Pérez"),
     *             @OA\Property(property="email", type="string", example="juan.perez@example.com"),
     *             @OA\Property(property="telefono", type="string", example="+591123456789"),
     *             @OA\Property(property="estado", type="string", example="activo"),
     *             @OA\Property(property="tipo_personal_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Personal académico actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/PersonalAcademico")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {

        $personalAcademico = PersonalAcademico::find($id);

        if (!$personalAcademico) {
            return response()->json([
                'message' => 'Personal académico no encontrado.'
            ], 404);
        }

        $personalAcademico->nombre = $request->input('name');
        $personalAcademico->email = $request->input('email');
        $personalAcademico->telefono = $request->input('telefono');
        $personalAcademico->estado = $request->input('estado');
        $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

        $personalAcademico->save();

        return response()->json([
            'message' => 'Personal académico actualizado exitosamente.',
            'personal_academico' => $personalAcademico
        ], 200);
    }

}
