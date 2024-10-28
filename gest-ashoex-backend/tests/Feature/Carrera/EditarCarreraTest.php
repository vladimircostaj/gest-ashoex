<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Carrera; 

class EditarCarreraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function editarCarreraExitosamente(): void
    {
        $carrera = Carrera::create([
            'nombre' => 'Licenciatura en Ingeniería Industrial',
            'nro_semestres' => 10,
        ]);

        // Datos actualizados
        $data = [
            'nombre' => 'Licenciatura en Ingeniería Industrial Actualizada',
            'nro_semestres' => 9,
        ];

        $response = $this->putJson("/api/carreras/{$carrera->id}", $data);

        $response->assertStatus(200);

        // Verificamos que la estructura de la respuesta sea la esperada
        $response->assertJson([
            'success' => true,
            'data' => [
                'id' => $carrera->id,
                'nombre' => 'Licenciatura en Ingeniería Industrial Actualizada',
                'nro_semestres' => 9,
            ],
            'error' => [],
            'message' => 'Operación exitosa',
        ]);

        $this->assertDatabaseHas('carreras', [
            'id' => $carrera->id,
            'nombre' => 'Licenciatura en Ingeniería Industrial Actualizada',
            'nro_semestres' => 9,
        ]);
    }

    /** @test */
    public function testerroresValidacionEnEdicion(): void
    {
        $carrera = Carrera::create([
            'nombre' => 'Licenciatura en Ingeniería Industrial',
            'nro_semestres' => 10,
        ]);

        // Datos incorrectos que no pasarán la validación
        $data = [
            'nombre' => '',
            'nro_semestres' => 13,
        ];

        $response = $this->putJson("/api/carreras/{$carrera->id}", $data);

        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nombre es obligatorio.',
                ],
                [
                    'status' => 422,
                    'detail' => 'El campo nro semestres no debe ser mayor a 12.',
                ],
            ],
            'message' => 'Error',
        ]);

        // Verificamos que los datos en la base de datos no se hayan cambiado
        $this->assertDatabaseHas('carreras', [
            'id' => $carrera->id,
            'nombre' => 'Licenciatura en Ingeniería Industrial',
            'nro_semestres' => 10,
        ]);
    }
}
