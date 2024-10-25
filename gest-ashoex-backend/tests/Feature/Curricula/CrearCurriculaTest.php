<?php

namespace Tests\Feature\Curricula;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Curricula;
use App\Models\Carrera;
use App\Models\Materia;

class CrearCurriculaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_curricula_successfully()
    {
        // Crear datos de prueba para carrera y materia
        $carrera = Carrera::factory()->create();
        $materia = Materia::factory()->create();

        // Datos de entrada
        $data = [
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
            'electiva' => false,
        ];

        // Hacer la solicitud POST
        $response = $this->postJson('/api/curriculas', $data);

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Operacion exitosa',
                     'data' => [
                         'carrera_id' => $carrera->id,
                         'materia_id' => $materia->id,
                         'nivel' => 1,
                         'electiva' => false,
                     ],
                 ]);

        // Verificar que el registro se haya creado en la base de datos
        $this->assertDatabaseHas('curriculas', $data);
    }

    /** @test */
    public function it_fails_to_create_curricula_due_to_validation_errors()
    {
        // Datos de entrada incompletos
        $data = [
            'carrera_id' => null,
            'materia_id' => null,
            'nivel' => null,
            'electiva' => null,
        ];

        // Hacer la solicitud POST
        $response = $this->postJson('/api/curriculas', $data);

        // Verificar que la respuesta tenga errores de validación
        $response->assertStatus(422)
                 ->assertJson([
                     'success' => false,
                     'data' => [],
                     'message' => 'Operacion fallida',
                     'errors' => [
                         'carrera_id' => ['The carrera id field is required.'],
                         'materia_id' => ['The materia id field is required.'],
                         'nivel' => ['The nivel field is required.'],
                         'electiva' => ['The electiva field is required.'],
                     ],
                 ]);
    }
}
