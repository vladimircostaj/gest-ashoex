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

   /** @test */
  public function it_creates_a_new_curricula_json_successfuly()
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
                    'message' => 'Operación exitosa',
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
                    'message' => 'Error',
                    'error' => [
                        [
                            'status' => 422,
                            'detail' => 'El campo carrera id es obligatorio.'
                        ],
                        [
                            'status' => 422,
                            'detail' => 'El campo materia id es obligatorio.'
                        ],
                        [
                            'status' => 422,
                            'detail' => 'El campo nivel es obligatorio.'
                        ],
                        [
                            'status' => 422,
                            'detail' => 'El campo electiva es obligatorio.'
                        ]
                    ]
               ]);
  }

   /** @test */
  public function error_curricula_con_id_carrera_materia_ya_creada()
  {
      // Crear datos de prueba para carrera y materia
      $carrera = Carrera::factory()->create();
      $materia = Materia::factory()->create();

      // Crear una currícula con los datos de prueba
      $curricula = Curricula::factory()->create([
          'carrera_id' => $carrera->id,
          'materia_id' => $materia->id,
      ]);

      // Datos de entrada
      $data = [
          'carrera_id' => $carrera->id,
          'materia_id' => $materia->id,
          'nivel' => 1,
          'electiva' => false,
      ];

      // Hacer la solicitud POST
      $response = $this->postJson('/api/curriculas', $data);

      // Verificar que la respuesta tenga errores de validación
      $response->assertStatus(409)
               ->assertJson([
                   'success' => false,
                    'data' => [],
                    'message' => 'Error en la solicitud',
                    'error' => [
                            "code" => 409,
                            "message" => "Ya existe una Curricula con los mismos carrera_id y materia_id"
                    ]
               ]);
  }

  /** @test */
  public function error_curricula_con_nivel_no_coincide_con_nro_semestre_carrera()
  {
      // Crear datos de prueba para carrera y materia
      $carrera = Carrera::factory()->create();
      $materia = Materia::factory()->create();

      // Datos de entrada
      $data = [
          'carrera_id' => $carrera->id,
          'materia_id' => $materia->id,
          'nivel' => 12,
          'electiva' => false,
      ];

      // Hacer la solicitud POST
      $response = $this->postJson('/api/curriculas', $data);

      // Verificar que la respuesta tenga errores de validación
      $response->assertStatus(400)
               ->assertJson([
                   'success' => false,
                    'data' => [],
                    'message' => 'Error en la solicitud',
                    'error' => [
                        'code' => 400,
                        'message' => 'El nivel no puede ser mayor que el número de semestres de la carrera'
                    ]
               ]);
  }

  /** @test */
  public function error_curricula_nivel_menor_uno()
  {
        // Crear datos de prueba para carrera y materia
        $carrera = Carrera::factory()->create();
        $materia = Materia::factory()->create();
    
        // Datos de entrada
        $data = [
            'carrera_id' => $carrera->id,
            'materia_id' => $materia->id,
            'nivel' => 0,
            'electiva' => false,
        ];
    
        // Hacer la solicitud POST
        $response = $this->postJson('/api/curriculas', $data);
    
        // Verificar que la respuesta tenga errores de validación
        $response->assertStatus(400)
                 ->assertJson([
                     'success' => false,
                        'data' => [],
                        'message' => 'Error en la solicitud',
                        'error' => [
                            'code' => 400,
                            'message' => 'El nivel no puede ser menor que 1'
                        ]
                 ]);
  }



   
}
