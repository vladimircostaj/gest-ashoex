<?php

namespace Tests\Feature;

use App\Models\Materia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CrearMateriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_materia_successfully()
    {

        $data = [
            'codigo' => 1000001,
            'nombre' => 'Física',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                     "success" => true,
                     "error" => [],
                     "message" => "Operación exitosa",
                     "data" => [
                         'codigo' => $data['codigo'],
                         'nombre' => $data['nombre'],
                         'tipo' => $data['tipo'],
                         'nro_PeriodoAcademico' => $data['nro_PeriodoAcademico'],
                     ]
                 ]);

        $this->assertDatabaseHas('materias', $data);
    }
    
}
