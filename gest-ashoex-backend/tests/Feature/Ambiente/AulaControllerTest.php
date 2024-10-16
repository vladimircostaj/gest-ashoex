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

    /**
     * Test para registrar un aula con un número ya en uso
     */
    public function testRegistrarAulaConNumeroYaEnUso(): void
    {
        $aula = Aula::factory()->create(['numero_aula' => 'A101']);

        $data = [
            'numero_aula' => 'A101',  // El mismo número de aula
            'capacidad' => 60,
            'habilitada' => true,
            'id_ubicacion' => $aula->id_ubicacion,
        ];

        $response = $this->postJson('/api/aulas', $data);

        $response->assertStatus(409)
            ->assertJson([
                'success' => false,
                'data' => null,
                'error' => [
                    'code' => 409,
                    'message' => 'Conflicto',
                ],
                'message' => 'Datos de entrada inválidos, aula ya registrada',
            ]);
    }

     /**
     * Test para actualizar un aula existente
     */
    public function testActualizarAulaExitosamente(): void
    {
        $aula = Aula::factory()->create();

        $data = [
            'numero_aula' => 'A102',
            'capacidad' => 70,
            'habilitada' => false,
            'id_ubicacion' => $aula->id_ubicacion,
        ];

        $response = $this->putJson("/api/aulas/{$aula->id_aula}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'numero_aula' => 'A102',
                    'capacidad' => 70,
                    'habilitada' => false,
                ],
                'message' => 'Aula actualizada exitosamente',
            ]);

        $this->assertDatabaseHas('aula', [
            'numero_aula' => 'A102',
            'capacidad' => 70,
        ]);
    }
}
