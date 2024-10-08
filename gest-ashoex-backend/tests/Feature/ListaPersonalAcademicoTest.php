<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PersonalAcademico; // Asegúrate de usar el modelo correcto
use App\Models\TipoPersonal; // Asegúrate de usar el modelo correcto
use Illuminate\Support\Facades\DB;

class ListaPersonalAcademicoTest extends TestCase
{
    use RefreshDatabase; // Esto restablecerá la base de datos después de cada prueba

    public function test_lista_personal_academico_retorna_datos_correctos()
    {
        // Crear datos de prueba
        $tipoPersonal = TipoPersonal::create(['nombre' => 'Profesor']);
        $personalAcademico = PersonalAcademico::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'telefono' => '123456789',
            'estado' => 'activo',
            'tipo_personal_id' => $tipoPersonal->id,
        ]);

        // Hacer una solicitud a la ruta
        $response = $this->get('/api/lista-personal-academico');

        // Afirmar que la respuesta es correcta
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    [
                        'Tipo_personal' => 'Profesor',
                        'telefono' => '123456789',
                        'personal_academico_id' => $personalAcademico->id,
                        'tipo_personal_id' => $tipoPersonal->id,
                        'name' => 'Juan Pérez',
                        'email' => 'juan@example.com',
                        'estado' => 'activo',
                    ],
                ],
                'error' => null,
                'message' => 'Operación exitosa'
            ]);
    }

    public function test_lista_personal_academico_no_encontrado()
    {
       
        $response = $this->get('/api/personal');

        
        $response->assertStatus(204)
            ->assertJson([
                'success' => true,
                'data' => null,
                'error' => null,
                'message' => 'No se encontraron registros'
            ]);
    }

    public function test_lista_personal_academico_error()
    {
        DB::shouldReceive('table')
            ->once()
            ->andThrow(new \Exception('Error en la base de datos'));

        $response = $this->get('/api/personal');

        $response->assertStatus(500)
            ->assertJson([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 500,
                    'message' => 'Error en la solicitud: Error en la base de datos',
                ],
                'message' => 'Error en la solicitud'
            ]);
    }
}
