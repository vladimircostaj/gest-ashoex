<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Curricula;
use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class EliminarCurriculaTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_eliminar_curricula_con_dato_existente()
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
        echo 'Curricula ID: ' . $curricula->id;
        $response = $this->delete("/api/curriculas/{$curricula->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('curriculas', ['id' => $curricula->id]);
    }




    #[Test]
    public function test_eliminar_curricula_con_dato_inexistente()
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
        echo 'Curricula ID: ' . $curricula->id;
        $response = $this->delete("/api/curriculas/999");
        $response->assertStatus(404);
       // $this->assertDatabaseMissing('curriculas', ['id' => $curricula->id]);
    }

    public function test_duplicados_y_eliminacion_multiple()
    {
        $this->expectException(QueryException::class);

        $carrera = Carrera::create([
            'nombre' => 'Ingeniería en Electromecánica',
            'nro_semestres' => 8,
        ]);

        $materia = Materia::create([
            'codigo' => 1000003,
            'nombre' => 'Física III',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        $curricula1 = Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
        ]);

        // Intento de duplicado, que debería lanzar QueryException
        Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
        ]);
    }
}

   

