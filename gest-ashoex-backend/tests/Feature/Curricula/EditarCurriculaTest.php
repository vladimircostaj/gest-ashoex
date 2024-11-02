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

    public function setUp(): void
    {
        parent::setUp();
        
        $this->carrera = Carrera::create(['nombre' => 'Ingeniería Industrial', 'nro_semestres' => 10]);
        $this->materia = Materia::create([
            'codigo' => 2000001,
            'nombre' => 'Matemática',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);
        $this->curricula = Curricula::create([
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 1,
            'electiva' => false,
        ]);
    }

    public function test_actualiza_curricula_correctamente()
    {           
        $newData = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];
        
        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $newData);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     "success" => true,
                     "data" => [
                         "id" => $this->curricula->id,
                         "carrera_id" => $this->carrera->id,
                         "materia_id" => $this->materia->id,
                         "nivel" => 2,
                         "electiva" => true,
                     ],
                     "error" => [],
                     "message" => "Operación exitosa"
                 ]);
        
        $this->assertDatabaseHas('curriculas', [
            'id' => $this->curricula->id,
            'nivel' => 2,
            'electiva' => true,
        ]);
    }
    public function test_falla_cuando_carrera_no_esta()
    {
        $data = [
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo carrera id es obligatorio."
                        ]
                    ]
                ]);
    }
    public function test_falla_cuando_carrera_id_no_es_entero()
    {
        $data = [
            'carrera_id' => 'texto',
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo carrera id debe ser un número entero."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_carrera_id_no_existe()
    {
        $data = [
            'carrera_id' => 9999,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo carrera id seleccionado no existe."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_materia_id_no_existe()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => 9999,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo materia id seleccionado no existe."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_materia_id_no_es_entero()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => 'texto',
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo materia id debe ser un número entero."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_nivel_no_es_mayor_a_cero()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 0,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo nivel debe ser al menos 1."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_electiva_no_es_booleana()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => 'texto',
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo electiva debe ser verdadero o falso."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_nivel_no_es_entero()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 'texto',
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo nivel debe ser un número entero."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_materia_id_es_vacio()
    {
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => '',
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo materia id es obligatorio."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_carrera_id_es_vacio()
    {
        $data = [
            'carrera_id' => '',
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "El campo carrera id es obligatorio."
                         ]
                     ]
                 ]);
    }
    public function test_falla_cuando_carrera_id_y_materia_id_ya_existen()
    {   
        $this->materia2 = Materia::create([
            'codigo' => 2000002,
            'nombre' => 'Calculo',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 2,
        ]);
        $this->curricula2 = Curricula::create([
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia2->id,
            'nivel' => 2,
            'electiva' => false,
        ]);
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula2->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "La combinación de carrera y materia ya existe en la base de datos."
                         ]
                     ]
                 ]);
    }

    public function test_falla_cuando_materia_id_y_carrera_id_ya_existen()
    {   
        $this->carrera2 = Carrera::create(['nombre' => 'Ingeniería Agronoma', 'nro_semestres' => 10]);
        $this->curricula2 = Curricula::create([
            'carrera_id' => $this->carrera2->id,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => false,
        ]);
        $data = [
            'carrera_id' => $this->carrera->id,
            'materia_id' => $this->materia->id,
            'nivel' => 2,
            'electiva' => true,
        ];

        $response = $this->putJson("/api/curriculas/{$this->curricula2->id}", $data);

        $response->assertStatus(422)
                 ->assertJson([
                     "success" => false,
                     "data" => [],
                     "message" => "Error",
                     "error" => [
                         [
                             "status" => 422,
                             "detail" => "La combinación de carrera y materia ya existe en la base de datos."
                         ]
                     ]
                 ]);
    }
    
}
