<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\PersonalAcademico;
use Exception;

class PersonalAcademicoController extends Controller
{
    public function ListaPersonalAcademico() {
        try {
           
            $personalAcademicos = PersonalAcademico::with('tipoPersonal')->get();
    
            if ($personalAcademicos->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'data' => [],
                    'error' => [
                        'code' => 204,
                        'message' => 'No se encontró datos'
                    ],
                    'message' => 'Lista vacía'
                ], 204);
            }
    
            
            $result = [];
            

            foreach ($personalAcademicos as $personal) {
                $result[] = [
                    'Tipo_personal' => $personal->tipoPersonal->nombre,
                    'telefono' => $personal->telefono,
                    'personal_academico_id' => $personal->id,
                    'tipo_personal_id' => $personal->tipo_personal_id,
                    'nombre' => $personal->nombre,
                    'email' => $personal->email,
                    'estado' => $personal->estado,
                ];
            }
    
            return response()->json([
                'success' => true,
                'data' => $result,
                'error' => null,
                'message' => 'Operación exitosa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => 'Error: ' . $e->getMessage()
                ],
                'message' => 'Error en la solicitud'
            ], 404);
        }
    }
    

    public function darDeBaja(int $id): JsonResponse
    {
        try {
            $personalAcademicoID = $id;
            $personalAcademico = PersonalAcademico::find($personalAcademicoID);
            if (!$personalAcademico) {
                return parent::response(
                    false,
                    [], 
                    'El personal academico seleccionado no existe.', 
                    [
                        'code' => 404,
                        'message' => 'Personal no encontrado.'
                    ]
                );
            }
            $dadoBaja = $personalAcademico->darBaja();
            return parent::response(
                $dadoBaja, 
                $personalAcademico->toArray(), 
                (
                    $dadoBaja? 
                    'Se dio de baja correctamente al personal academico: ' . $personalAcademico->nombre :
                    'El personal academico: ' . $personalAcademico->nombre . ' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
                ),
                ($dadoBaja? []: 
                    ['code' => 400, 'message' => 'Dado de baja 2 veces.'])
            );
        } catch (\Exception $e) {
            return parent::response(
                false, 
                [],
                'Ocurrio un error en el servidor.',
                ['code' => 500, 'message' => $e->getMessage()]
            );
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
    public function test_obtener_lista_de_personal_academico_exitosamente()
    {
        // Se inserta datos en la tabla
        DB::table('tipo_personals')->insert([
            ['id' => 1, 'nombre' => 'Auxiliar'],
            ['id' => 2, 'nombre' => 'Titular']
        ]);

        DB::table('personal_academicos')->insert([
            [
                'id' => 1,
                'name' => 'Patrick Almanza',
                'email' => 'patralm@gmail.com',
                'telefono' => '69756409',
                'estado' => 'Activo',
                'tipo_personal_id' => 1
            ]
        ]);

        $response = $this->get('/personal-academicos');

        // Verificar que la respuesta sea correcta 
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Operación exitosa',
            'data' => [
                [
                    'Tipo_personal' => 'Auxiliar',
                    'telefono' => '69756409',
                    'personal_academico_id' => 1,
                    'tipo_personal_id' => 1,
                    'name' => 'Patrick Almanza',
                    'email' => 'patralm@gmail.com',
                    'estado' => 'Activo'
                ]
            ]
        ]);
    }
}
