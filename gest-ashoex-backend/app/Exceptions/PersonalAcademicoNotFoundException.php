<?php

namespace App\Exceptions;

use Exception;

class PersonalAcademicoNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => false,
            'data' => null,
            'error' => [
                'status' => 404,
                'detail' => "Personal académico con ese ID no encontrado.",
            ],
            'message' => 'Error en la solicitud.'
        ], 404);
    }
}
