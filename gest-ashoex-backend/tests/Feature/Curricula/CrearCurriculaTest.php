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
      // Crea una nueva carrera
      $carrera = Carrera::create([
          'nombre' => 'Ingeniería en Electromecánica',
          'nro_semestres' => 8,
      ]);

      // Crea una nueva materia
      $materia = Materia::create([
          'codigo' => 1000003,  // Cambié el código para evitar duplicados si pruebas manualmente
          'nombre' => 'Física III',
          'tipo' => 'regular',
          'nro_PeriodoAcademico' => 1,
      ]);

      // Crea una nueva currícula
      $curricula = Curricula::create([
          'carrera_id' => $carrera->id,
          'materia_id' => $materia->id,
          'nivel' => 1,
      ]);

      // Asegúrate de que la currícula se creó correctamente
      $this->assertDatabaseHas('curriculas', ['id' => $curricula->id]);
  }

   
}
