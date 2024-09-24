<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\PersonalAcademico;
use App\Models\TipoPersonal;
class PersonalAcademicoController extends Controller
{
public function ListaPersonalAcademico(){
    $personalAcademicos = DB::table('personal_academicos')
    ->join('tipo_personals', 'personal_academicos.tipo_personal_id', '=', 'tipo_personals.id')
    ->select('tipo_personals.nombre as Tipo_personal','personal_academicos.telefono','tipo_personals.carga_horaria as carga_horaria','personal_academicos.id as personal_academico_id', 'tipo_personals.id as tipo_personal_id', 'personal_academicos.nombre', 'personal_academicos.email')
    ->get();
 return response() ->json($personalAcademicos);

}
}
