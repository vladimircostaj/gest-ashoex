<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\PersonalAcademico; 
use App\Models\TipoPersonal;
use Database\Seeders\DatabaseSeeder;

class PersonalAcademicoTest extends TestCase
{
    use RefreshDatabase; // limpira la base de datos con con cada llamada a los test
    
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * Test para registrar nuevo personal academico
     */
    public function testRegistrarPersonalAcademicoExitosamente(): void
    {
        $tipoPersonal = TipoPersonal::factory()->create();

        $data = [
            'nombre' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telefono' => '+59171234567',
            'estado' => 'ACTIVO',
            'tipo_personal_id' => $tipoPersonal->id
        ];

        $response = $this->postJson('/api/personal-academico', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'nombre' => 'John Doe',
                    'email' => 'john.doe@example.com',
                    'telefono' => '+59171234567',
                    'estado' => 'ACTIVO',
                    'tipo_personal_id' => $tipoPersonal->id,
                ],
                'error' => null,
                'message' => 'Personal academico registrado exitosamente',
            ]);

        $this->assertDatabaseHas('personal_academicos', [
            'email' => 'john.doe@example.com',
        ]);
    }

    /**
     * Test de registro de personal con email ya en uso
     */
    
    
    public function testRegistrarPersonalAcademicoEmailYaEnUso(): void
    {
        PersonalAcademico::factory()->create([
            'email' => 'john.doe@example.com'
        ]);

        $data = [
            'nombre' => 'John Doe',
            'email' => 'john.doe@example.com',
            'telefono' => '+59171234567',
            'estado' => 'ACTIVO',
            'tipo_personal_id' => 2
        ];

        $response = $this->postJson('/api/personal-academico', $data);

        $response->assertStatus(409)
            ->assertJson([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'Conflicto',
                ],
                'message' => 'Datos de entrada inválidos, registro ya existente',
            ]);
    }

    public function testRegistrarPersonalAcademicoConExcepcion()
    {
        $this->mock(PersonalAcademico::class, function ($mock) {
            $mock->shouldReceive('create')->andReturn(null);
        });
        
        $tipoPersonal = TipoPersonal::factory()->create();

        $data = [
            'nombre' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'telefono' => '+59171234568',
            'estado' => 'ACTIVO',
            'tipo_personal_id' => 1
        ];
        $response = $this->postJson('/api/personal-academico', $data);
        $response->assertStatus(500);
    }
    
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function testDarDeBajaPersonalExistente()
    {
        $personalAcademico = PersonalAcademico::factory()->create();
        $data = [
            'id' => $personalAcademico->id
        ];
        $response = $this->patchJson('/api/personal-academicos/dar-baja', $data); 
        $response->assertOk()
            ->assertJson([
                'data' => 'Se dio de baja correctamente al personal academico: '.$personalAcademico->nombre
            ]);
        $this->assertDatabaseHas(
            'personal_academicos', 
            [
                'id' => $personalAcademico->id, 
                'nombre' => $personalAcademico->nombre,
                'email' => $personalAcademico->email, 
                'estado' => config('constants.PERSONAL_ACADEMICO_ESTADOS')[1]
            ]
        );
        $response = $this->patchJson('/api/personal-academicos/dar-baja', $data); 
        $response->assertOk()
            ->assertJson([
                'data' => 'El personal academico: '.$personalAcademico->nombre.' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
            ]);
    }

    public function testVisualizarPersonalAcademico()
    {
        $tipoPersonal = TipoPersonal::factory()->create([
            'nombre' => 'Docente',
        ]);

        $personalAcademico = PersonalAcademico::factory()->create([
            'tipo_personal_id' => $tipoPersonal->id,
            'estado' => 'ACTIVO', 
        ]);
        $response = $this->getJson("/api/personal-academicos/{$personalAcademico->id}");

        $response->dump();
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'nombre',
                'email',
                'telefono',
                'estado',
                'tipo_personal' => [
                    'id',
                    'nombre',
                ],
            ],
            'error',
            'message',
        ]);

        $response->assertJson([
            'success' => true,
            'message' => 'Operación exitosa',
            'data' => [
                'id' => $personalAcademico->id,
                'nombre' => $personalAcademico->nombre,
                'email' => $personalAcademico->email,
                'telefono' => $personalAcademico->telefono,
                'estado' => 'ACTIVO',
                'tipo_personal' => [
                    'id' => $tipoPersonal->id,
                    'nombre' => 'Docente',
                ],
            ],
        ]);

    }
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
