<?php

namespace Tests\Feature;

use App\Models\Aula;
use App\Models\Ubicacion;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AulaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Ejecutar el seeder para poblar las tablas necesarias
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test para registrar un aula exitosamente
     */
    public function testRegistrarAulaExitosamente(): void
    {
        $ubicacion = Ubicacion::factory()->create();

        $data = [
            'numero_aula' => 'A101',
            'capacidad' => 50,
            'habilitada' => true,
            'id_ubicacion' => $ubicacion->id_ubicacion,
        ];

        $response = $this->postJson('/api/aulas', $data);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'numero_aula' => 'A101',
                    'capacidad' => 50,
                    'habilitada' => true,
                    'id_ubicacion' => $ubicacion->id_ubicacion,
                ],
                'error' => null,
                'message' => 'Aula registrada exitosamente',
            ]);

        $this->assertDatabaseHas('aula', [
            'numero_aula' => 'A101',
        ]);
    }
}
