<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $materias = Materia::all();    
            if ($materias->isEmpty()) {
                return response()->json([
                    'error' => 'No se encontraron materias',
                ], Response::HTTP_NOT_FOUND); 
            }
            return response()->json($materias, Response::HTTP_OK);    
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'Error en la consulta a la base de datos',
                'detalle' => $e->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
    
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return response()->json([
                'error' => 'No tienes permiso para acceder a estas materias',
                'detalle' => $e->getMessage(),
            ], Response::HTTP_FORBIDDEN);
    
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error inesperado',
                'detalle' => $e->getMessage(),
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
