<?php

namespace App\Http\Controllers;

use App\Models\Uso;
use Illuminate\Http\Request;

class UsoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/usos",
     *     tags={"Uso"},
     *     summary="Obtener todos los usos",
     *     description="Retorna una lista de todos los usos registrados en el sistema",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usos obtenida correctamente",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="tipo_uso", type="string", example="Clase"),
     *                 @OA\Property(property="id_aula", type="integer", example=101),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-10-20T14:48:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-10-20T14:48:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en el servidor al obtener los usos"
     *     )
     * )
    */
    public function index()
    {
        return Uso::all();
    }

    // Obtener un uso por su ID
    public function show($id)
    {
        return Uso::findOrFail($id);
    }

    // Crear un nuevo uso
    public function store(Request $request)
    {
        $request->validate([
            'tipo_uso' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $uso = Uso::create($request->all());

        return response()->json($uso, 201);
    }

    // Actualizar un uso existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_uso' => 'required|string|max:100',
            'id_aula' => 'required|exists:aula,id_aula',
        ]);

        $uso = Uso::findOrFail($id);
        $uso->update($request->all());

        return response()->json($uso, 200);
    }

    // Eliminar un uso
    public function destroy($id)
    {
        $uso = Uso::findOrFail($id);
        $uso->delete();

        return response()->json(null, 204);
    }
}
