<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Curricula;
use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class EditarCurriculaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_editar_curricula()
    {
        // Crear Carrera
        $carrera = Carrera::create([
            'nombre' => 'Ingeniería en Electromecánica',
            'nro_semestres' => 8,
        ]);

        // Crear Materia
        $materia = Materia::create([
            'codigo' => 1000003,
            'nombre' => 'Física III',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        // Crear Curricula
        $curricula = Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
        ]);

        // Preparar datos actualizados
        $updatedData = [
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 2,
        ];

        // Verificar que la Curricula existe en la base de datos
        $this->assertDatabaseHas('curriculas', ['id' => $curricula->id]);

        // Enviar la solicitud PUT para actualizar
        $response = $this->putJson("/api/curriculas/{$curricula->id}", $updatedData);

        // Verificar que la respuesta es exitosa
        $response->assertStatus(200);

        // Verificar que los datos se han actualizado correctamente en la base de datos
        $this->assertDatabaseHas('curriculas', [
            'id' => $curricula->id,
            'nivel' => 2, // El nivel debe haber cambiado a 2
        ]);

        // Verificar que la respuesta contiene los datos actualizados
        $response->assertJsonFragment($updatedData);
    }
}
