<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\PersonalAcademico;
use Exception;

class PersonalAcademicoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/personal-academicos",
     *     operationId="getListaPersonalAcademico",
     *     tags={"Personal Académico"},
     *     summary="Obtiene la lista de todo el personal académico",
     *     description="Devuelve una lista de todo el personal académico registrado.",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de personal académico obtenida exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/PersonalAcademico")
     *             ),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Error al obtener la lista de personal académico",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="No se encontró personal académico")
     *         )
     *     )
     * )
     */
    public function ListaPersonalAcademico()
    {
        try {
            $personalAcademicos = PersonalAcademico::with('tipoPersonal')->get();

            if ($personalAcademicos->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'error' => [
                        'code' => 204,
                        'message' => 'No se encontró datos'
                    ],
                    'message' => 'Lista vacía'
                ], 204);
            }

            $result = [];

            foreach ($personalAcademicos as $personal) {
                $result[] = [
                    'Tipo_personal' => $personal->tipoPersonal->nombre,
                    'telefono' => $personal->telefono,
                    'personal_academico_id' => $personal->id,
                    'tipo_personal_id' => $personal->tipo_personal_id,
                    'nombre' => $personal->nombre,
                    'email' => $personal->email,
                    'estado' => $personal->estado,
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $result,
                'error' => null,
                'message' => 'Operación exitosa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => 'Error: ' . $e->getMessage()
                ],
                'message' => 'Error en la solicitud'
            ], 404);
        }
    }

    /**
     * @OA\Patch(
     *     path="/api/personal-academicos/{id}/dar-baja",
     *     tags={"Personal Académico"},
     *     operationId="darDeBajaPersonalAcademico",
     *     summary="Dar de baja a un personal académico",
     *     description="Cambia el estado de un personal académico a 'INACTIVO'.",
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
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/PersonalAcademico"),
     *             @OA\Property(property="error", type="object", example=null),
     *             @OA\Property(property="message", type="string", example="Se dio de baja correctamente al personal academico: Juan Pérez")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="El personal académico ya fue dado de baja",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="object", nullable=true, example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=400),
     *                 @OA\Property(property="message", type="string", example="Dado de baja 2 veces.")
     *             ),
     *             @OA\Property(property="message", type="string", example="El personal academico: Juan Pérez ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="object", nullable=true, example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=404),
     *                 @OA\Property(property="message", type="string", example="Personal no encontrado.")
     *             ),
     *             @OA\Property(property="message", type="string", example="El personal academico seleccionado no existe.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="object", nullable=true, example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=500),
     *                 @OA\Property(property="message", type="string", example="Error interno del servidor")
     *             ),
     *             @OA\Property(property="message", type="string", example="Ocurrio un error en el servidor.")
     *         )
     *     )
     * )
     */
    public function darDeBaja(int $id): JsonResponse
    {
        try {
            $personalAcademicoID = $id;
            $personalAcademico = PersonalAcademico::find($personalAcademicoID);
            if (!$personalAcademico) {
                return parent::response(
                    false,
                    [],
                    'El personal academico seleccionado no existe.',
                    [
                        'code' => 404,
                        'message' => 'Personal no encontrado.'
                    ]
                );
            }
            $dadoBaja = $personalAcademico->darBaja();
            return parent::response(
                $dadoBaja,
                $personalAcademico->toArray(),
                (
                    $dadoBaja ?
                    'Se dio de baja correctamente al personal academico: ' . $personalAcademico->nombre :
                    'El personal academico: ' . $personalAcademico->nombre . ' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
                ),
                ($dadoBaja ? [] :
                    ['code' => 400, 'message' => 'Dado de baja 2 veces.'])
            );
        } catch (\Exception $e) {
            return parent::response(
                false,
                [],
                'Ocurrio un error en el servidor.',
                ['code' => 500, 'message' => $e->getMessage()]
            );
        }
    }

    /**
     * @OA\Post(
     *     path="/api/personal-academico",
     *     tags={"Personal Académico"},
     *     operationId="registrarPersonalAcademico",
     *     summary="Registrar un nuevo personal académico",
     *     description="Crea un nuevo registro de personal académico.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "email", "telefono", "estado", "tipo_personal_id"},
     *             @OA\Property(property="nombre", type="string", example="Juan Pérez"),
     *             @OA\Property(property="email", type="string", format="email", example="juan.perez@example.com"),
     *             @OA\Property(property="telefono", type="string", example="+59171234567"),
     *             @OA\Property(property="estado", type="string", example="ACTIVO"),
     *             @OA\Property(property="tipo_personal_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Personal académico registrado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/PersonalAcademico"),
     *             @OA\Property(property="error", type="object", example=null),
     *             @OA\Property(property="message", type="string", example="Personal academico registrado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflicto - Registro ya existente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=409),
     *                 @OA\Property(property="message", type="string", example="Conflicto")
     *             ),
     *             @OA\Property(property="message", type="string", example="Datos de entrada inválidos, registro ya existente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=500),
     *                 @OA\Property(property="message", type="string", example="Error interno del servidor")
     *             ),
     *             @OA\Property(property="message", type="string", example="Descripción del error")
     *         )
     *     )
     * )
     */
    public function registrar(Request $request): JsonResponse
    {
        $existingUser = PersonalAcademico::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'Conflicto'
                ],
                'message' => 'Datos de entrada inválidos, registro ya existente'
            ], 409);
        }
        try {
            $personalAcademico = PersonalAcademico::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'estado' => $request->estado,
                'tipo_personal_id' => $request->tipo_personal_id,
            ]);

            return response()->json([
                'success' => true,
                'data' => $personalAcademico,
                'error' => null,
                'message' => 'Personal academico registrado exitosamente',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "data" => null,
                "error" => [
                    "code" => 500,
                    "message" => "Error interno del servidor"
                ],
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/personal-academicos/{id}",
     *     tags={"Personal Académico"},
     *     operationId="mostrarInformacionPersonalAcademico",
     *     summary="Mostrar la información de un personal académico por ID",
     *     description="Obtiene los detalles de un personal académico específico.",
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
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/PersonalAcademico"),
     *             @OA\Property(property="error", type="object", example=null),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=404),
     *                 @OA\Property(property="message", type="string", example="Personal académico no encontrado")
     *             ),
     *             @OA\Property(property="message", type="string", example="Error en la solicitud")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en la solicitud",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null", example=null),
     *             @OA\Property(
     *                 property="error",
     *                 type="object",
     *                 @OA\Property(property="code", type="integer", example=500),
     *                 @OA\Property(property="message", type="string", example="Descripción del error")
     *             ),
     *             @OA\Property(property="message", type="string", example="Error en la solicitud")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $personalAcademico = PersonalAcademico::with('tipoPersonal')->find($id);

            if (!$personalAcademico) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'error' => [
                        'code' => 404,
                        'message' => 'Personal académico no encontrado'
                    ],
                    'message' => 'Error en la solicitud'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $personalAcademico,
                'error' => null,
                'message' => 'Operación exitosa'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ],
                'message' => 'Error en la solicitud'
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/personal-academico/{id}",
     *     tags={"Personal Académico"},
     *     operationId="actualizarPersonalAcademico",
     *     summary="Actualizar la información de un personal académico",
     *     description="Actualiza los datos de un personal académico existente.",
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
     *             required={"nombre", "email", "telefono", "estado", "tipo_personal_id"},
     *             @OA\Property(property="nombre", type="string", example="Juan Pérez"),
     *             @OA\Property(property="email", type="string", format="email", example="juan.perez@example.com"),
     *             @OA\Property(property="telefono", type="string", example="+59171234567"),
     *             @OA\Property(property="estado", type="string", example="ACTIVO"),
     *             @OA\Property(property="tipo_personal_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Personal académico actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Personal académico actualizado exitosamente."),
     *             @OA\Property(property="personal_academico", ref="#/components/schemas/PersonalAcademico")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personal académico no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Personal académico no encontrado.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Descripción del error")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $personalAcademico = PersonalAcademico::find($id);

        if (!$personalAcademico) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => 'Personal académico no encontrado.'
                ],
                'message' => 'Error en la solicitud.'
            ], 404);
        }

        $emailExistente = PersonalAcademico::where('email', $request->input('email'))->where('id', '!=', $id)->exists();

        if ($emailExistente) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'El correo electrónico ya está registrado.'
                ],
                'message' => 'Error en la solicitud.'
            ], 409);
        }

        try {

            $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|email',
                'telefono' => 'required|string',
                'estado' => 'required|string',
                'tipo_personal_id' => 'required|integer|exists:tipo_personals,id'
            ]);

            $personalAcademico->nombre = $request->input('nombre');
            $personalAcademico->email = $request->input('email');
            $personalAcademico->telefono = $request->input('telefono');
            $personalAcademico->estado = $request->input('estado');
            $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

            $personalAcademico->save();

            return response()->json([
                'success' => true,
                'data' => $personalAcademico,
                'error' => null,
                'message' => 'Operación exitosa.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 400,
                    'message' => 'Datos de entrada inválidos.'
                ],
                'message' => 'Error en la solicitud.'
            ], 400);
        }
    }

    public function eliminar(int $id)
    {
        $personalAcademico = PersonalAcademico::find($id);
        if ($personalAcademico) {
            $personalAcademico->delete();
        }
        return response()->noContent();
    }

    public function reactivar($id)
    {
        $personalAcademico = PersonalAcademico::find($id);
        
        if (!$personalAcademico) {
            return response()->json([
                'success' => false,
                'message' => 'Personal académico no encontrado',
            ], 404);
        }

        // Cambiar el estado del personal a "activo" (o como lo tengas configurado)
        $personalAcademico->estado = 'ACTIVO'; // Asegúrate de que este valor exista en tu base de datos
        $personalAcademico->save();

        return response()->json([
            'success' => true,
            'message' => 'Personal académico reactivado exitosamente',
            'data' => $personalAcademico,
        ]);
    }

    public function test_obtener_lista_de_personal_academico_exitosamente()
    {
        // Se inserta datos en la tabla
        DB::table('tipo_personals')->insert([
            ['id' => 1, 'nombre' => 'Auxiliar'],
            ['id' => 2, 'nombre' => 'Titular']
        ]);

        DB::table('personal_academicos')->insert([
            [
                'id' => 1,
                'nombre' => 'Patrick Almanza',
                'email' => 'patralm@gmail.com',
                'telefono' => '69756409',
                'estado' => 'Activo',
                'tipo_personal_id' => 1
            ]
        ]);

        $response = $this->get('/personal-academicos');

        // Verificar que la respuesta sea correcta
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Operación exitosa',
            'data' => [
                [
                    'Tipo_personal' => 'Auxiliar',
                    'telefono' => '69756409',
                    'personal_academico_id' => 1,
                    'tipo_personal_id' => 1,
                    'nombre' => 'Patrick Almanza',
                    'email' => 'patralm@gmail.com',
                    'estado' => 'Activo'
                ]
            ]
        ]);
    }
}

/**
 * @OA\Schema(
 *     schema="PersonalAcademico",
 *     type="object",
 *     required={"id", "nombre", "email", "telefono", "estado", "tipo_personal_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="Juan Pérez"),
 *     @OA\Property(property="email", type="string", format="email", example="juan.perez@example.com"),
 *     @OA\Property(property="telefono", type="string", example="+59171234567"),
 *     @OA\Property(property="estado", type="string", example="ACTIVO"),
 *     @OA\Property(property="tipo_personal_id", type="integer", example=1),
 *     @OA\Property(property="Tipo_personal", type="string", example="Auxiliar"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2021-08-01T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2021-08-01T00:00:00Z")
 * )
 */
