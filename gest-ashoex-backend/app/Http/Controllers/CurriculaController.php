<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Curricula;
use App\Models\Materia;

class CurriculaController extends Controller{

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
     *     tags={"Curricula"},
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
    public function store(Request $request){
        $rules = [
            'carrera_id' => 'required|integer|exists:carreras,id',
            'materia_id' => 'required|integer|exists:materias,id',
            'nivel' => 'required|integer',
            'electiva' => 'required|boolean'
            
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => [],
                'errors' => $validator->errors(),
                'message' => 'Operacion fallida',
            ], 422);
        }

        $curricula = new Curricula();
        $curricula->carrera_id = $request->input('carrera_id');
        $curricula->materia_id = $request->input('materia_id');
        $curricula->nivel =      $request->input('nivel');
        $curricula->electiva =   $request->input('electiva');

        $curricula->save();

        return response()->json([
            'success' => true,
            'data' => $curricula, 
            'error' => [],
            'message' => 'Operacion exitosa',
        ], 201);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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
