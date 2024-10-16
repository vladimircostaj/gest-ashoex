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
}
