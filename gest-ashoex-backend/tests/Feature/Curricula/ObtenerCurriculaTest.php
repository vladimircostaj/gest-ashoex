<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Curricula;
use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ObtenerCurriculaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_obtener_curricula()
    {
        $carrera = Carrera::create([
            'nombre' => 'Ingeniería en Electromecánica',
            'nro_semestres' => 8,
        ]);

        $materia = Materia::create([
            'codigo' => 1000003,
            'nombre' => 'Física III ',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        $curricula = Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
        ]);
        $this->assertDatabaseHas('curriculas', ['id' => $curricula->id]);
       // echo 'Curricula ID: ' . $curricula->id;
       $response = $this->get("/api/curriculas/{$curricula->id}");
       $response->assertStatus(200);
       // $this->assertDatabaseMissing('curriculas', ['id' => $curricula->id]);
    }
}

   

