<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaPersonalAcademicoController extends Controller
{
    public function ListaPersonalAcademico(){
        $personalAcademicos = DB::table('personal_academicos')
        ->join('tipo_personals', 'personal_academicos.tipo_personal_id', '=', 'tipo_personals.id')
        ->select('tipo_personals.nombre as Tipo_personal','personal_academicos.telefono','personal_academicos.id as personal_academico_id', 'tipo_personals.id as tipo_personal_id', 'personal_academicos.name', 'personal_academicos.email','personal_academicos.estado')
        ->get();
     return response() ->json($personalAcademicos);
    
    }
}

