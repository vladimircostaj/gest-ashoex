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
     * Funcion para dar de baja a un personal academico especificado por su ID
     * @param int $personalAcademicoID - ID especifico de un personal academico 
     * @return JsonResponse - retorna una respuesta JSON, que sigue la estructura acordada, con una descripcion de lo que paso con la peticion
     */
    public function darDeBaja(int $personalAcademicoID): JsonResponse
    {
        try {
            $personalAcademico = PersonalAcademico::find($personalAcademicoID); 
            if (!$personalAcademico) {
                return parent::response(
                    false, 
                    [], 
                    'Error en la solicitud', 
                    [
                        [
                            'code' => 404, 
                            'message' => 'El personal academico seleccionado no existe'
                        ],
                    ]
                ); 
            }
            $dadoDeBaja = $personalAcademico->darBaja();
            $errors = [];
            if (!$dadoDeBaja) {
                $errors =  ['code' => 428,
                    'message' => 'El personal academico debe estar habilitado'];
            }
            return parent::response(
                $dadoDeBaja, 
                $personalAcademico->toArray(), 
                (
                    $dadoDeBaja ? 
                    'Se dio de baja correctamente al personal academico: '.$personalAcademico->nombre :
                    'El personal academico: '.$personalAcademico->nombre.' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
                ),
                $errors
            );
        } catch (\Exception $e) {
            return parent::response(
                false, 
                [], 
                'Error en la solicitud',
                [
                    'code' => 500, 
                    'message' => $e->getMessage()
                ]
            ); 
        }
    }

    public function registrar(Request $request)
    {
        $personalAcademico = PersonalAcademico::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'estado' => $request->estado,
            'tipo_personal_id' => $request->tipo_personal_id,
        ]);

        return response()->json([
            'message' => 'Personal académico registrado exitosamente',
            'personalAcademico' => $personalAcademico
        ], 201);
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
