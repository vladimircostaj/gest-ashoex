<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CrearCurriculaRequest;
use App\Http\Requests\ActualizarCurriculaRequest;

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
     *     tags={"Curriculas"},
     *     summary="Almacena una nueva Curricula en la base de datos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"carrera_id", "materia_id", "nivel", "electiva"},
     *             @OA\Property(property="carrera_id", type="number", example=5),
     *             @OA\Property(property="materia_id", type="number", example=10),
     *             @OA\Property(property="nivel", type="number", example=7),
     *             @OA\Property(property="electiva", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Curricula creada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="number", example=1),
     *                     @OA\Property(property="carrera_id", type="number", example=5),
     *                     @OA\Property(property="materia_id", type="number", example=10),
     *                     @OA\Property(property="nivel", type="number", example=7),
     *                     @OA\Property(property="electiva", type="boolean", example=false),
     *                     @OA\Property(property="created_at", type="string", example="2021-09-01T00:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", example="2021-09-01T00:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="error", type="array", 
     *                  @OA\Items(), example={}),
     *             @OA\Property(property="message", type="string", example="Operación exitosa")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Error de validación",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",@OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="code", type="string", example="400"),
     *                     @OA\Property(property="detail", type="string", example="El campo 'nivel' es requerido.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error en la conexión a la base de datos"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="data", type="array",@OA\Items(), example={}),
     *             @OA\Property(property="error", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="detail", type="string", example="The selected carrera_id is invalid.")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Error"),
     *         )
     *     )
     * )
     */
    public function store(CrearCurriculaRequest $request){
        
        $curricula = new Curricula();
        $curricula->carrera_id = $request->input('carrera_id');
        $curricula->materia_id = $request->input('materia_id');
        $curricula->nivel =      $request->input('nivel');
        $curricula->electiva =   $request->input('electiva');
    return response()->json([
            'success' => true,
            'data' => $curricula, 
            'error' => [],
            'message' => 'Operacion exitosa',
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
     $curricula = Curricula::find($id);
 
     if ($curricula) {
         return response()->json([
             "success" => true,
             "data" => [
                 "id" => $curricula->id,
                 "carrera_id" => $curricula->carrera_id,
                 "materia_id" => $curricula->materia_id,
                 "nivel" => $curricula->nivel,
                 "electiva"=>$curricula->electiva,
             ],
             "error" => [],
             "message" => "Operación exitosa"
         ], 200);
     } else {
         return response()->json([
             "success" => false,
             "data" => [],
             "error" => ["La curricula no existe"],
             "message" => "Operación fallida"
         ], 404);
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
 public function update(ActualizarCurriculaRequest $request, string $id)
 {
     $curricula = Curricula::find($id);
     
     if ($curricula) {
         $data = $request->only(['carrera_id', 'materia_id', 'nivel', 'electiva']);
         $curricula->update($data);
 
         return response()->json([
             "success" => true,
             "data" => [
                 "id" => $curricula->id,
                 "carrera_id" => $curricula->carrera_id,
                 "materia_id" => $curricula->materia_id,
                 "nivel" => $curricula->nivel,
                 "electiva" => $curricula->electiva,
             ],
             "error" => [],
             "message" => "Operación exitosa"
         ], 200);
     } else {
         return response()->json([
             "success" => false,
             "data" => [],
             "error" => ["ID no encontrado"],
             "message" => "Operación fallida"
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
