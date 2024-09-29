<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{

    public function index()
    {
        $grupos = Grupo::all();
       return response()->json($grupos,200);
    }

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
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
