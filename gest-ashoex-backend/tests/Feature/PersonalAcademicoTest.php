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

    /**
     * Test de registro de personal correctamente
     */
    public function testRegistrarPersonalAcademicoExitoso(): void
    {
        $tipoPersonal = TipoPersonal::factory()->create();

        $data = [
            'nombre' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'telefono' => '+59171234568',
            'estado' => 'ACTIVO',
            'tipo_personal_id' => $tipoPersonal->id
        ];

        $response = $this->postJson('/api/personal-academico', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'nombre' => 'Jane Doe',
                    'email' => 'jane.doe@example.com',
                    'telefono' => '+59171234568',
                    'estado' => 'ACTIVO',
                    'tipo_personal_id' => $tipoPersonal->id,
                    'id' => $response->json('data.id'),
                ],
                'error' => null,
                'message' => 'Personal academico registrado exitosamente',
            ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test para buscar personal academico no existente
     */
    public function testBuscarPersonalAcademicoNoExistente()
    {
        $response = $this->get('/api/personal-academicos/-1'); 
        $response->assertNotFound();
        $response->assertJsonCount(0);
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
}
