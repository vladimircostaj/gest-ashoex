<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\PersonalAcademico;
use Exception;

class PersonalAcademicoController extends Controller
{
    public function ListaPersonalAcademico(){
        $personalAcademicos = DB::table('personal_academicos')
        ->join('tipo_personals', 'personal_academicos.tipo_personal_id', '=', 'tipo_personals.id')
        ->select('tipo_personals.nombre as Tipo_personal','personal_academicos.telefono','personal_academicos.id as personal_academico_id', 'tipo_personals.id as tipo_personal_id', 'personal_academicos.nombre', 'personal_academicos.email','personal_academicos.estado')
        ->get();
     return response() ->json($personalAcademicos);
    
    }

    public function darDeBaja(Request $request): JsonResponse
    {
        try {
            $personalAcademicoID = $request->id;
            $personalAcademico = PersonalAcademico::find($personalAcademicoID);
            if (!$personalAcademico) {
                return response()->json([
                    'data' => 'El personal academico seleccionado no existe.'
                ], 404);
            }
            return response()->json([
                'data' => (
                    $personalAcademico->darBaja() ?
                    'Se dio de baja correctamente al personal academico: ' . $personalAcademico->nombre :
                    'El personal academico: ' . $personalAcademico->nombre . ' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
                )
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function registrar(Request $request): JsonResponse
    {   
        $existingUser = PersonalAcademico::where('email', $request->email)->first();
        
        if ($existingUser) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'Conflicto'
                ],
                'message' => 'Datos de entrada inválidos, registro ya existente'
            ], 409);
        }
        try {
            $personalAcademico = PersonalAcademico::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'estado' => $request->estado,
                'tipo_personal_id' => $request->tipo_personal_id,
            ]);

            return response()->json([
                'success'=> true,
                'data' => $personalAcademico,
                'error'=> null,
                'message' => 'Personal academico registrado exitosamente',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                "success"=> false,
                "data"=> null,
                "error"=> [
                    "code"=> 500,
                    "message"=> "Error interno del servidor"
                ],
                "message"=> $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Buscar el registro de PersonalAcademico por ID
            $personalAcademico = PersonalAcademico::with('tipoPersonal')->find($id);
            // Verificar si existe
            if (!$personalAcademico) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'error' => [
                        'code' => 404,
                        'message' => 'Personal académico no encontrado'
                    ],
                    'message' => 'Error en la solicitud'
                ], 404);
            }

            // Retornar los datos del personal académico
            return response()->json([
                'success' => true,
                'data' => $personalAcademico,
                'error' => null,
                'message' => 'Operación exitosa'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 500,
                    'message' => $e->getMessage()
                ],
                'message' => 'Error en la solicitud'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        $personalAcademico = PersonalAcademico::find($id);

        if (!$personalAcademico) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => 'Personal académico no encontrado.'
                ],
                'message' => 'Error en la solicitud.'
            ], 404);
        }

        $emailExistente = PersonalAcademico::where('email', $request->input('email'))->where('id', '!=', $id)->exists();

        if ($emailExistente) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'El correo electrónico ya está registrado.'
                ],
                'message' => 'Error en la solicitud.'
            ], 409);
        }

        try {

            $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|email',
                'telefono' => 'required|string',
                'estado' => 'required|string',
                'tipo_personal_id' => 'required|integer|exists:tipo_personals,id'
            ]);

            $personalAcademico->nombre = $request->input('nombre');
            $personalAcademico->email = $request->input('email');
            $personalAcademico->telefono = $request->input('telefono');
            $personalAcademico->estado = $request->input('estado');
            $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

            $personalAcademico->save();

            return response()->json([
                'success' => true,
                'data' => $personalAcademico,
                'error' => null,
                'message' => 'Operación exitosa.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 400,
                    'message' => 'Datos de entrada inválidos.'
                ],
                'message' => 'Error en la solicitud.'
            ], 400);
        }

    }

}
