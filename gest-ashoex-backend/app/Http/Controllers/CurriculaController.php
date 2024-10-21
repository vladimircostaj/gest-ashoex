<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Curricula;
use App\Models\Materia;
class CurriculaController extends Controller
{
   /**
 * @OA\Get(
 *     path="/api/curriculas",
 *     summary="Obtener todas las Curriculas",
 *     description="Devuelve una lista de todas las Curriculas registradas",
 *     tags={"Curriculas"},
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="curriculas", type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="carrera_id", type="integer", example=1),
 *                     @OA\Property(property="materia_id", type="integer", example=2),
 *                     @OA\Property(property="nivel", type="integer", example=3)
 *                 )
 *             ),
 *             @OA\Property(property="code", type="integer", example=200)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No hay curriculas registradas",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="No hay curriculas registradas"),
 *             @OA\Property(property="code", type="integer", example=404)
 *         )
 *     )
 * )
 */

    public function index()
    {
        $curriculas = Curricula::all();
        $data = [];
        if($curriculas->isEmpty()){
            $data = ['message'=>'No hay curriculas registradas', 'code'=>404];
            return response()->json($data,404);
        }
        $data = ['curriculas'=>$curriculas, 'code'=>200];
        return response()->json($data,200);
        }

    /**
 * @OA\Post(
 *     path="/api/curriculas",
 *     summary="Crear una nueva Curricula",
 *     description="Registra una nueva Curricula en el sistema",
 *     tags={"Curriculas"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="carrera_id", type="integer", example=1, description="ID de la Carrera"),
 *             @OA\Property(property="materia_id", type="integer", example=2, description="ID de la Materia"),
 *             @OA\Property(property="nivel", type="integer", example=3, description="Nivel de la Curricula")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Curricula creada exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Curricula creada exitosamente"),
 *             @OA\Property(property="curricula", type="object", example={
 *                 "id": 1,
 *                 "carrera_id": 1,
 *                 "materia_id": 2,
 *                 "nivel": 3
 *             }),
 *             @OA\Property(property="code", type="integer", example=201)
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Errores de validación",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="errors", type="object", 
 *                @OA\Property(property="carrera_id", type="string", example="El campo carrera_id es requerido"),
 *                @OA\Property(property="materia_id", type="string", example="El campo materia_id es requerido")
 *             ),
 *             @OA\Property(property="code", type="integer", example=422)
 *         )
 *     )
 * )
 */
    public function store(Request $request){
        $rules = [
            'carrera_id' => 'required|integer|exists:carreras,id',
            'materia_id' => 'required|integer|exists:materias,id',
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'code' => 422
            ], 422);
        }

        $curricula = new Curricula();
        $curricula->carrera_id = $request->input('carrera_id');
        $curricula->materia_id = $request->input('materia_id');
        $curricula->nivel =      $request->input('nivel');

        $curricula->save();

        return response()->json([
            'message' => 'Curricula creada exitosamente',
            'curricula' => $curricula,
            'code' => 201
        ], 201);
    }

    /**
 * @OA\Get(
 *     path="/api/curriculas/{id}",
 *     summary="Obtener detalles de una Curricula",
 *     description="Devuelve los detalles de una Curricula específica según su ID",
 *     tags={"Curriculas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la Curricula a mostrar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object", example={
 *                 "id": 1,
 *                 "carrera_id": 2,
 *                 "materia_id": 3,
 *                 "nivel": 4
 *             }),
 *             @OA\Property(property="error", type="array", @OA\Items()),
 *             @OA\Property(property="message", type="string", example="Operacion exitosa")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Curricula no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="array", 
 *                @OA\Items(type="string", example="La curricula no existe")
 *             ),
 *             @OA\Property(property="message", type="string", example="Operacion fallida")
 *         )
 *     )
 * )
 */

    public function show(string $id)
    {
        $curricula=Curricula::find($id);
        if($curricula){
            
            return response()->json([
                "success"=> true,
                "data"=> [],
                "error"=> [],
                "message"=> "Operacion exitosa"
            ],200);  
        }else{
            return response()->json([
                "success"=> false,
                "data"=> [],
                "error"=> ["La curricula no existe"],
                "message"=> "Operacion fallida"
            ],404);  
        }
    }

    /**
 * @OA\Put(
 *     path="/api/curriculas/{id}",
 *     summary="Actualizar una Curricula",
 *     description="Actualiza los detalles de una Curricula existente",
 *     tags={"Curriculas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la Curricula a actualizar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="carrera_id", type="integer", example=1, description="ID de la Carrera (opcional)"),
 *             @OA\Property(property="materia_id", type="integer", example=2, description="ID de la Materia (opcional)"),
 *             @OA\Property(property="nivel", type="integer", example=3, description="Nivel de la Curricula (opcional)")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="array", @OA\Items()),
 *             @OA\Property(property="message", type="string", example="Operacion exitosa")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Curricula no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="array", 
 *                @OA\Items(type="string", example="id no encontrado")
 *             ),
 *             @OA\Property(property="message", type="string", example="Operacion fallida")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Errores de validación",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="object", 
 *                @OA\Property(property="carrera_id", type="string", example="El campo carrera_id no es válido"),
 *                @OA\Property(property="materia_id", type="string", example="El campo materia_id no es válido")
 *             ),
 *             @OA\Property(property="message", type="string", example="Operacion fallida")
 *         )
 *     )
 * )
 */

    public function update(Request $request, string $id)
    {
        $rules = [
            'carrera_id' => 'nullable|integer|exists:carreras,id',
            'materia_id' => 'nullable|integer|exists:materias,id',
            
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                "success"=> false,
                "data"=> [],
                "error"=> $validator->errors(),
                "message"=> "Operacion fallida"
            ], 422);
        }
       $curricula = Curricula::find($id);
       if ($curricula){
        $curricula->update($request->all);
        return response()->json([
            "success"=> true,
            "data"=> [],
            "error"=> [],
            "message"=> "Operacion exitosa"
        ], 200);
       }else{
        return response()->json([
            "success"=> true,
            "data"=> [],
            "error"=> ["id no encontrado"],
            "message"=> "Operacion fallida"
        ], 404);
       }
       
    }

   /**
 * @OA\Delete(
 *     path="/api/curriculas/{id}",
 *     summary="Eliminar una Curricula",
 *     description="Elimina una Curricula existente según su ID",
 *     tags={"Curriculas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la Curricula a eliminar",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Operación exitosa",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="array", @OA\Items()),
 *             @OA\Property(property="message", type="string", example="Operacion exitosa")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Curricula no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="data", type="array", @OA\Items()),
 *             @OA\Property(property="error", type="array", 
 *                @OA\Items(type="string", example="Curricula no encontrada")
 *             ),
 *             @OA\Property(property="message", type="string", example="Operacion fallida")
 *         )
 *     )
 * )
 */
    public function destroy(string $id)
    {
        $curricula = Curricula::find($id);
        if($curricula){
            $curricula->delete();
        return response()->json([
                "success"=>true,
                "data"=>[],
                "error"=>[],
                "message"=>"Operacion exitosa"
        ],200);
        }else{
            return response()->json([
                "success"=>false,
                "data"=>[],
                "error"=>["Curricula no encontrada"],
                "message"=>"Operacion fallida"
            ],404); 
        }
        
    }
}
