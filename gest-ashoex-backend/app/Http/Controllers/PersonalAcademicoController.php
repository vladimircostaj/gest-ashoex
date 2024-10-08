<?php

namespace App\Http\Controllers;

use Illuminate\Http\{
    Request,
    JsonResponse
};

use App\Models\PersonalAcademico;

class PersonalAcademicoController extends Controller
{
    public function index(int $id): JsonResponse
    {
        try {
            $personalAcademico = PersonalAcademico::find($id); 
            return response()->json(
                $personalAcademico, 
                (
                    !$personalAcademico? 
                    404: 
                    200
                )
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server error D:', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Funcion para dar de baja a un personal academico especifico 
     * @param Request $request Este es request debe contener un JSON el cual debe tener al menos el id del personal academico a dar de baja, el esqueleto debe ser: {`id`: 'value'} 
     * @return JsonResponse Pasa como respuesta un respuesta JSON, con un mensaje que describe lo que paso con la peticion
     */
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
                    'Se dio de baja correctamente al personal academico: '.$personalAcademico->nombre :
                    'El personal academico: '.$personalAcademico->nombre.' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
                )
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Server error D:', 
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
        // Buscar el registro de PersonalAcademico por ID
        $personalAcademico = PersonalAcademico::with('tipoPersonal')->find($id);
        // Verificar si existe
        if (!$personalAcademico) {
            return response()->json(['message' => 'Personal académico no encontrado'], 404);
        }

        // Retornar los datos del personal académico
        return response()->json($personalAcademico, 200);
    }

    public function update(Request $request, $id)
    {

        $personalAcademico = PersonalAcademico::find($id);

        if (!$personalAcademico) {
            return response()->json([
                'message' => 'Personal académico no encontrado.'
            ], 404);
        }

        $personalAcademico->nombre = $request->input('name');
        $personalAcademico->email = $request->input('email');
        $personalAcademico->telefono = $request->input('telefono');
        $personalAcademico->estado = $request->input('estado');
        $personalAcademico->tipo_personal_id = $request->input('tipo_personal_id');

        $personalAcademico->save();

        return response()->json([
            'message' => 'Personal académico actualizado exitosamente.',
            'personal_academico' => $personalAcademico
        ], 200);
    }

}