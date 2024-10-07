<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrera;
use App\Http\Requests\CrearCarreraRequest;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Response;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         try {
             $carreras = Carrera::all();    
                  if ($carreras->isEmpty()) {
                 return response()->json([
                     'success' => false,
                     'data' => [],
                     'error' => ['No se encontraron carreras'],
                     'message' => 'Operación fallida'
                 ], Response::HTTP_NOT_FOUND); 
             }     
             return response()->json([
                 'success' => true,
                 'data' => $carreras,
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
                 'error' => ['No tienes permiso para acceder a estas carreras'],
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
    public function store(CrearCarreraRequest $request)
    {
        $validated = $request->validated();
        $carrera = Carrera::create(['nombre' => $validated['nombre']]);

        return response()->json([
            'message' => 'Carrera creada exitosamente',
            'carrera' => $carrera,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carrera=Carrera::find($id);
        return response()->json($carrera,200);

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
        $carrera = Carrera::find($id);
        if ($carrera){
            $carrera->delete();
            return response()->json([
                'success'=>true,
                'data'=>$carrera
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'data'=>$carrera
            ],404);
        }
    }
}
