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
}
