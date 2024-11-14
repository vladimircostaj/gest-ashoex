<?php

namespace Tests\Feature\Ambiente;

use App\Models\Ambientes\Aula;
use App\Models\Ambientes\Facilidad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacilidadControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function testRegistrarFacilidadExitosamente(): void {
        $aula = Aula::factory()->create();
    
        $data = [
            'nombre_facilidad' => 'Proyector',
            'aulas' => [$aula->id_aula],
        ];
    
        $response = $this->postJson('/api/facilidades', $data);
    
        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'nombre_facilidad' => 'Proyector',
                    'id_facilidad' => $aula->id_facilidad, 
                ],
                'error' => null,
                'message' => 'Facilidad registrada exitosamente',
            ]);
    
        $this->assertDatabaseHas('facilidad', [
            'nombre_facilidad' => 'Proyector',
        ]);
    }
    

    public function testRegistrarFacilidadConNombreEnBlanco(): void {
        $data = [
            'nombre_facilidad' => '',
        ];
    
        $response = $this->postJson('/api/facilidades', $data);
    
        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => [
                    [
                        'status' => 422,
                        'detail' => 'The nombre facilidad field is required.'
                    ]
                ],
                'message' => 'Error'
            ]);
    }
    

    public function testActualizarFacilidadExitosamente(): void
    {
        $aula = Aula::factory()->create();
    
        $facilidadExistente = Facilidad::factory()->create([
            'nombre_facilidad' => 'Computadora',
        ]);
    
        
        $facilidadExistente->aulas()->sync([$aula->id_aula]);
    
        $datosActualizados = [
            'nombre_facilidad' => 'Impresora',
            'aulas' => [$aula->id_aula], 
        ];
    
        $response = $this->putJson("/api/facilidades/{$facilidadExistente->id_facilidad}", $datosActualizados);
    
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id_facilidad' => $facilidadExistente->id_facilidad,
                    'nombre_facilidad' => 'Impresora',
                ],
                'error' => null,
                'message' => 'Facilidad actualizada exitosamente',
            ]);
    
        $this->assertDatabaseHas('facilidad', [
            'id_facilidad' => $facilidadExistente->id_facilidad,
            'nombre_facilidad' => 'Impresora',
        ]);
    }
    
    public function testEliminarFacilidadExitosamente(): void {
        $facilidad = Facilidad::factory()->create();

        $response = $this->deleteJson("/api/facilidades/{$facilidad->id_facilidad}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => null,
                'error' => null,
                'message' => 'Facilidad eliminada exitosamente',
            ]);

        $this->assertDatabaseMissing('facilidad', [
            'id_facilidad' => $facilidad->id_facilidad,
        ]);
    }

    public function testActualizarFacilidadNoExistente(): void{
        $data = [
            'nombre_facilidad' => 'Pizarra Inteligente',
        ];

        $response = $this->putJson('/api/facilidades/-1', $data); 

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'data' => null,
                'error' => ['Facilidad no encontrada'],
                'message' => 'No se pudo actualizar la facilidad',
        ]);
    }


}
