<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Carrera; 
use App\Models\Curricula; 
use App\Models\Materia; 

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
    /** @test */
    public function eliminarCurriculaCuandoSeReduceNumeroDeSemestres(): void
    {
        // Crea una carrera con un número inicial de semestres
        $carrera = Carrera::create([
            'nombre' => 'Licenciatura en Sistemas',
            'nro_semestres' => 8,
        ]);

        // Crea una nueva materia
        $materia = Materia::create([
            'codigo' => 1000003,  
            'nombre' => 'Física III',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        // Crea un registro en la tabla `curriculas` para el último semestre
        $curriculaUltimoSemestre = Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 8,
        ]);

        // Verifica que la `curricula` en el último semestre esté en la base de datos
        $this->assertDatabaseHas('curriculas', [
            'id' => $curriculaUltimoSemestre->id,
            'carrera_id' => $carrera->id,
            'nivel' => 8,
        ]);

        $data = [
            'nombre' => 'Licenciatura en Sistemas Actualizada',
            'nro_semestres' => 7,  
        ];

        $response = $this->putJson("/api/carreras/{$carrera->id}", $data);

        $response->assertStatus(200);

        // Verifica que el registro en `curriculas` para el nivel 8 haya sido eliminado
        $this->assertDatabaseMissing('curriculas', [
            'id' => $curriculaUltimoSemestre->id,
            'carrera_id' => $carrera->id,
            'nivel' => 8,
        ]);

        // Verifica que la carrera ha sido actualizada en la base de datos
        $this->assertDatabaseHas('carreras', [
            'id' => $carrera->id,
            'nombre' => 'Licenciatura en Sistemas Actualizada',
            'nro_semestres' => 7,
        ]);
    }
}
