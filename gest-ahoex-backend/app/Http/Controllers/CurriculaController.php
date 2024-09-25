<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curricula;
use App\Models\Materia;
class CurriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
