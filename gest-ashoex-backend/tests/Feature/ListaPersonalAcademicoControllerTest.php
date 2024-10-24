<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class ListaPersonalAcademicoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que se obtenga la lista completa de personal académico.
     *
     * @return void
     */
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

    /**
     * Test: Verificar cuando no se encuentra personal académico.
     *
     * @return void
     */
    public function test_no_se_encuentra_personal_academico()
    {
        // Asegurarse de que no haya datos en la tabla
        DB::table('personal_academicos')->truncate();

        $response = $this->get('/personal-academicos');

        // Verificar que la respuesta sea 204 (sin contenido)
        $response->assertStatus(204);
        $response->assertJson([
            'success' => false,
            'message' => 'Lista vacía',
            'data' => []
        ]);
    }

    /**
     * Test: Verificar que maneja correctamente errores del servidor.
     *
     * @return void
     */
    public function test_error_en_la_solicitud()
    {
        // Simular un error en la base de datos (por ejemplo, desconexión)
        DB::shouldReceive('table')->andThrow(new \Exception('Error de conexión'));
        
        $response = $this->get('/personal-academicos');

        // Verificar que la respuesta sea 404 con el mensaje de error
        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'message' => 'Error en la solicitud',
            'data' => null,
            'error' => [
                'code' => 404,
                'message' => 'Datos de entrada inválidos: Error de conexión'
            ]
        ]);
    }
}
