<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Curricula;
use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;


class EditarCurriculaTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_curricula_successfully()
    {
        // Crear una carrera y materia para el test
        $carrera = Carrera::create(['nombre' => 'Ingeniería de Sistemas','nro_semestres' => 8]);
        $materia = Materia::create([
            'codigo' => 1000001,
            'nombre' => 'Física',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        // Crear un registro de curricula
        $curricula = Curricula::create([
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 1,
            'electiva' => false,
        ]);

        // Datos para actualizar
        $newData = [
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        // Realizar la solicitud PUT
        $response = $this->putJson("/api/curriculas/{$curricula->id}", $newData);

        // Verificar respuesta y base de datos
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     "success" => true,
                     "data" => [
                         "id" => $curricula->id,
                         "carrera_id" => $carrera->id,
                         "materia_id" => $materia->id,
                         "nivel" => 2,
                         "electiva" => true,
                     ],
                     "error" => [],
                     "message" => "Operación exitosa"
                 ]);

        // Confirmar que los datos se han actualizado en la base de datos
        $this->assertDatabaseHas('curriculas', [
            'id' => $curricula->id,
            'nivel' => 2,
            'electiva' => true,
        ]);
    }

    public function test_validacion_falla_con_campos_vacios()
    {
        $data = [
            'carrera_id' => ' ',
            'materia_id' => ' ',
            'nivel' => ' ',
            'electiva' => ' '
        ];

        $response = $this->postJson('/api/curriculas', $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         ["status" => 422, "detail" => "El campo carrera id es obligatorio."],
                         ["status" => 422, "detail" => "El campo materia id es obligatorio."],
                         ["status" => 422, "detail" => "El campo nivel es obligatorio."],
                         ["status" => 422, "detail" => "El campo electiva es obligatorio."]
                     ]
                 ]);
    }
}
