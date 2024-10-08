<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Curricula;
use App\Models\Materia;
class CurriculaController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
        $curricula->save();

        return response()->json([
            'message' => 'Curricula creada exitosamente',
            'curricula' => $curricula,
            'code' => 201
        ], 201);
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
       $request ->validate([
        'nombre'=>'required|max:255',
        'materias'=>'required',
       ]);
       $curricula = Curricula::find($id);
       $curricula->update($request->all);
       return redirect()->back()->with('success','la curricula ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curricula = Curricula::find($id);
        $curricula->delete();
        return redirect()->back()->with('success','la curricula ha sido eliminada con exito');
    }
}
