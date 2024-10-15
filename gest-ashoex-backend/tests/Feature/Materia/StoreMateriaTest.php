<?php

namespace Tests\Feature;

use App\Models\Materia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class MateriaStoreTest extends TestCase
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

    public function test_store_fails_with_duplicate_codigo()
    {
        Materia::create([
            'codigo' => 1000001,
            'nombre' => 'Química',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        $data = [
            'codigo' => 1000001,
            'nombre' => 'Biología',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 2,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJsonValidationErrors('codigo');
    }

    public function test_store_fails_with_missing_fields()
    {
        $data = [
            'nombre' => 'Matemáticas',
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJsonValidationErrors(['codigo', 'tipo', 'nro_PeriodoAcademico']);
    }
}
