<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    
    public function index()
{
    try {
        $materias = Materia::all();
        if ($materias->isEmpty()) {
            return response()->json([
                'success' => false,
                'data' => [],
                'error' => ['No se encontraron materias'],
                'message' => 'Operación fallida'
            ], Response::HTTP_NOT_FOUND); 
        }
        return response()->json([
            'success' => true,
            'data' => $materias,
            'error' => [],
            'message' => 'Operación exitosa'
        ], Response::HTTP_OK);
    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'success' => false,
            'data' => [],
            'error' => ['Error en la consulta a la base de datos'],
            'message' => 'Operación fallida'
        ], Response::HTTP_BAD_REQUEST);
    } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
        return response()->json([
            'success' => false,
            'data' => [],
            'error' => ['No tienes permiso para acceder a estas materias'],
            'message' => 'Operación fallida'
        ], Response::HTTP_FORBIDDEN);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'data' => [],
            'error' => ['Ocurrió un error inesperado'],
            'message' => 'Operación fallida'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
