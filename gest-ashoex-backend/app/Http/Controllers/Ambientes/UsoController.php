<?php

namespace App\Http\Controllers\Ambientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ambientes\StoreUsoRequest;
use App\Http\Requests\Ambientes\UpdateUsoRequest;
use App\Models\Ambientes\Uso;


class UsoController extends Controller{
    /**
     * @OA\Get(
     *     path="/api/usos",
     *     summary="Obtener lista de usos",
     *     tags={"Usos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usos recuperada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id_uso", type="integer", example=1),
     *                     @OA\Property(property="tipo_uso", type="string", example="Uso de Aula")
     *                 )
     *             ),
     *             @OA\Property(property="error", type="string", nullable=true, example="null"),
     *             @OA\Property(property="message", type="string", example="Lista de usos recuperada exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error interno del servidor")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $usos = Uso::all();
        return response()->json([
            'success' => true,
            'data' => $usos,
            'error' => null,
            'message' => 'Lista de usos recuperada exitosamente'
        ]);
    }

    // Obtener un uso por su ID
        /**
     * @OA\Get(
     *     path="/api/usos/{id}",
     *     tags={"Usos"},
     *     summary="Obtiene un uso por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del uso a recuperar"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id_uso", type="integer", example=1),
     *                 @OA\Property(property="tipo_uso", type="string", example="Clases")
     *             ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example=null),
     *             @OA\Property(property="message", type="string", example="Uso recuperado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example=null),
     *             @OA\Property(property="error", type="string", example="Uso no encontrado"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $uso = Uso::find($id);
        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso no encontrado',
                'message' => ''
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso recuperado exitosamente'
        ]);
    }

    // Crear un nuevo uso
        /**
     * @OA\Post(
     *     path="/api/usos",
     *     tags={"Usos"},
     *     summary="Almacena un nuevo uso en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"tipo_uso"},
     *             @OA\Property(property="tipo_uso", type="string", example="Uso de oficina"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Uso registrado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="tipo_uso", type="string", example="Laboratorio de Quimica"),
     *                 @OA\Property(property="id_uso", type="integer", example=11)
     *             ),
     *             @OA\Property(property="error", type="array",
     *                  @OA\Items(), example=null),
     *             @OA\Property(property="message", type="string", example="Uso registrado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",@OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="Debe ingresar un tipo de uso valido.")
     *                 ), example={
     *                          {
     *                              "status": 422,
     *                              "detail": "Debe ingresar un tipo de uso valido."
     *                          }
     *                      }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error"),
     *         )
     *     )
     * )
     */

    public function store(StoreUsoRequest $request)
    {
        $uso = Uso::create($request->validated());
        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso registrado exitosamente'
        ], 201);
    }

    // Actualizar un uso existente
    /**
     * @OA\Put(
     *     path="/api/usos/{id}",
     *     tags={"Usos"},
     *     summary="Actualiza un uso existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del uso a actualizar"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"tipo_uso"},
     *             @OA\Property(property="tipo_uso", type="string", example="Uso de oficina")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uso actualizado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id_uso", type="integer", example=11),
     *                 @OA\Property(property="tipo_uso", type="string", example="Uso de oficina")
     *             ),
     *             @OA\Property(property="error", type="array", @OA\Items(type="string"), example=null),
     *             @OA\Property(property="message", type="string", example="Uso actualizado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(type="string", example="Uso de ambiente no encontrado")),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos de entrada inválidos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array", @OA\Items(), example={}),
     *              @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="status", type="string", example="422"),
     *                     @OA\Property(property="detail", type="string", example="El campo nombre_facilidad es obligatorio.")
     *                 ), example={
     *                     {
     *                         "status": 422,
     *                         "detail": "El campo tipo uso es obligatorio."
     *                     }
     *                 }
     *             ),
     *             @OA\Property(property="message", type="string", example="Error")
     *         )
     *     )
     * )
     */

    public function update(UpdateUsoRequest $request, $id)
    {
        $uso = Uso::find($id);

        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso de ambiente no encontrado',
                'message' => ''
            ], 404);
        }

        $uso->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $uso,
            'error' => null,
            'message' => 'Uso actualizado exitosamente'
        ]);
    }

    // Eliminar un uso
     /**
     * @OA\Delete(
     *     path="/api/usos/{id}",
     *     tags={"Usos"},
     *     summary="Elimina un uso por el ID proporcionado",
     *     description="Elimina un uso de la base de datos dado su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del uso",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uso eliminado exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                  @OA\Items(type="object"),
     *                  example=null
     *             ),
     *             @OA\Property(property="error", type="array",
     *                  @OA\Items(type="object"),
     *                  example=null
     *             ),
     *             @OA\Property(property="message", type="string", example="Uso eliminado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",
     *                  @OA\Items(type="object"),
     *                  example=null
     *             ),
     *             @OA\Property(property="error", type="string", example="Uso no encontrado."),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $uso = Uso::find($id);

        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso no encontrado',
                'message' => ''
            ], 404);
        }

        $uso->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'error' => null,
            'message' => 'Uso eliminado exitosamente'
        ], 204);
    }
}
