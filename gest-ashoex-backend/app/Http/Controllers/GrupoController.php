<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Materia;
use App\Http\Requests\CrearGrupoRequest;
use Illuminate\Http\Response;

class GrupoController extends Controller
{

    public function index()
    {
        try {
            $grupos = Grupo::all();
            if ($grupos->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'error' => ['No se encontraron grupos'],
                    'message' => 'Operación fallida'
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'success' => true,
                'data' => $grupos,
                'error' => [],
                'message' => 'Operación exitosa'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'error' => ['Ocurrió un error inesperado'],
                'message' => 'Operación fallida'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
/*
    public function store(Request $request)
    {
        $datos = $request->validate([
            'materia_id' =>'required',
            'nro_grupo' => 'required',
        ]);
        $grupo = new Grupo($datos);
        $grupo->save();
        return response()->json($grupo,201);
    }

    /**
     * Display the specified resource.
     
*    public function show(string $id)
*    {
*        $grupo = Grupo::find($id);
*        return response()->json($grupo,200);
*    }*/


    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/gruposUpdate/{id}",
     *     summary="Actualiza los datos de un grupo previamente creado",
     *     operationId="updateGrupo",
     *     tags={"Grupos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del grupo a actualizar",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="materia_id",
     *                 type="integer",
     *                 description="ID de la materia a la que pertenece el grupo"
     *             ),
     *             @OA\Property(
     *                 property="nro_grupo",
     *                 type="integer",
     *                 description="Número del grupo dentro de la materia"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Grupo actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="materia_id",
     *                         type="integer",
     *                         example=2
     *                     ),
     *                     @OA\Property(
     *                         property="nro_grupo",
     *                         type="integer",
     *                         example=3
     *                     ),
     *                     @OA\Property(
     *                         property="descripcion",
     *                         type="string",
     *                         example="Grupo actualizado"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items()
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Operación exitosa"
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
     *                 property="data",
     *                 type="array",
     *                 @OA\Items()
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="code",
     *                         type="integer",
     *                         example=404
     *                     ),
     *                     @OA\Property(
     *                         property="detail",
     *                         type="string",
     *                         example="Grupo no encontrado"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Error"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflicto: Ya existe un grupo con este número en la misma materia",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items()
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="code",
     *                         type="integer",
     *                         example=409
     *                     ),
     *                     @OA\Property(
     *                         property="detail",
     *                         type="string",
     *                         example="Ya existe un grupo con este número en la misma materia"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Operación fallida"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en el servidor al actualizar el grupo",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items()
     *             ),
     *             @OA\Property(
     *                 property="error",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="code",
     *                         type="integer",
     *                         example=500
     *                     ),
     *                     @OA\Property(
     *                         property="detail",
     *                         type="string",
     *                         example="Error al actualizar el grupo: [mensaje del error]"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Error"
     *             )
     *         )
     *     )
     * )
     */

     public function update(CrearGrupoRequest $request, $id)
     {
         try {
             $grupo = Grupo::findOrFail($id);
 
             $grupoExistente = Grupo::where('materia_id', $request->materia_id)
                                ->where('nro_grupo', $request->nro_grupo)
                                ->where('id', '!=', $grupo->id) 
                                ->first();
 
             if ($grupoExistente) {
                 return response()->json([
                     'success' => false,
                     'data' => [],
                     'error' =>  [
                                     'code' => Response::HTTP_CONFLICT,
                                     'detail' => 'Ya existe un grupo con este número en la misma materia'
                                 ],
                     'message' => 'Operación fallida'
                 ], Response::HTTP_CONFLICT);
             }
 
             $validatedData = $request->validated();
             $grupo->update(array_filter($validatedData));
 
             return response()->json([
                 'success' => true,
                 'data' => [
                     [
                         'id' => $grupo->id,
                         'materia_id' => $grupo->materia_id,
                         'nro_grupo' => $grupo->nro_grupo,
                         'descripcion' => 'Grupo actualizado'
                     ]
                 ],
                 'error' => [],
                 'message' => 'Operación exitosa'
             ], Response::HTTP_OK);
 
         }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
             return response()->json([
                 'success' => false,
                 'data' => [],
                 'error' => [
                     [
                         'code' => Response::HTTP_NOT_FOUND,
                         'detail' => 'Grupo no encontrado'
                     ]
                 ],
                 'message' => 'Error'
             ], Response::HTTP_NOT_FOUND);
         } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'data' => [],
                'error' => [
                    [
                        'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                        'detail' => 'Error al actualizar el grupo: ' . $e->getMessage(),
                    ]
                ],
                'message' => 'Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

/** 
*    public function destroy(string $id)
*    {
*        $grupo = Grupo::find($id)->delete();
*        return response()->json([
*            'success'=>true,
*            'data'=> $grupo
*        ],200);
 *   }*/
}
