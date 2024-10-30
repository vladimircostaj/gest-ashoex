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
     *         description="Error del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="string", nullable=true, example="null"),
     *             @OA\Property(property="error", type="string", example="Error del servidor"),
     *             @OA\Property(property="message", type="string", example="Hubo un error en el servidor")
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


    /**
     * @OA\Get(
     *     path="/api/usos/{id}",
     *     summary="Obtener un uso por ID",
     *     tags={"Usos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del uso"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uso recuperado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", 
     *                 @OA\Property(property="id_uso", type="integer", example=1),
     *                 @OA\Property(property="tipo_uso", type="string", example="Uso de Aula")
     *             ),
     *             @OA\Property(property="error", type="string", nullable=true , example="null"),
     *             @OA\Property(property="message", type="string", example="Uso recuperado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null" , example="null"),
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



    /**
     * @OA\Post(
     *     path="/api/usos",
     *     summary="Crear un nuevo uso",
     *     tags={"Usos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="tipo_uso", type="string", example="Uso de Aula")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Uso registrado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="tipo_uso", type="string", example="Uso de Aula"),
     *                 @OA\Property(property="id_uso", type="integer", example=1)
     *             ),
     *             @OA\Property(property="error", type="string", nullable=true, example=null),
     *             @OA\Property(property="message", type="string", example="Uso registrado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error en la validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null" , example="null"),
     *             @OA\Property(property="error", type="string", example="Error en la validación"),
     *             @OA\Property(property="message", type="string", example="Hubo un error en la validación")
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

    /**
     * @OA\Put(
     *     path="/api/usos/{id}",
     *     summary="Actualizar un uso existente",
     *     tags={"Usos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del uso"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="tipo_uso", type="string", example="Uso de Aula Actualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uso actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id_uso", type="integer", example=1),
     *                 @OA\Property(property="tipo_uso", type="string", example="Uso de Aula Actualizado")
     *             ),
     *             @OA\Property(property="error", type="string", nullable=true , example="null"),
     *             @OA\Property(property="message", type="string", example="Uso actualizado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null" , example="null"),
     *             @OA\Property(property="error", type="string", example="Uso de ambiente no encontrado"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     */
    public function update(UpdateUsoRequest $request, $id)
    {
        $uso = Uso::find($id);

        // Si no se encuentra, devolver un error 404
        if (!$uso) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => 'Uso de ambiente no encontrado',
                'message' => ''
            ], 404);
        }

        // Actualiza el uso si se encuentra
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
     *     summary="Eliminar un uso",
     *     tags={"Usos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del uso"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Uso eliminado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="null" , example="null"),
     *             @OA\Property(property="error", type="string", nullable=true , example="null"),
     *             @OA\Property(property="message", type="string", example="Uso eliminado exitosamente")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Uso no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="null" , example="null"),
     *             @OA\Property(property="error", type="string", example="Uso no encontrado"),
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
        ]);
    }
}
