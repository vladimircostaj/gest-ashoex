<?php

namespace Tests\Feature;

use App\Models\Materia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CrearMateriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_materia_successfully()
    {

        $data = [
            'codigo' => 1000001,
            'nombre' => 'Física',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                     "success" => true,
                     "error" => [],
                     "message" => "Operación exitosa",
                     "data" => [
                         'codigo' => $data['codigo'],
                         'nombre' => $data['nombre'],
                         'tipo' => $data['tipo'],
                         'nro_PeriodoAcademico' => $data['nro_PeriodoAcademico'],
                     ]
                 ]);

        $this->assertDatabaseHas('materias', $data);
    }

    public function test_store_validation_fails_with_empty_fields()
    {
        $data = [
            'codigo' => ' ',
            'nombre' => ' ',
            'tipo' => ' ',
            'nro_PeriodoAcademico' => ' '
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo codigo es obligatorio."
                        ],
                        [
                            "status" => 422,
                            "detail" => "El campo nombre es obligatorio."
                        ],
                        [
                            "status" => 422,
                            "detail" => "El campo tipo es obligatorio."
                        ],
                        [
                            "status" => 422,
                            "detail" => "El campo nro  periodo academico es obligatorio."
                        ]
                    ]
                ]);
    }
    public function test_store_validation_fails_with_duplicate_codigo()
    {
        Materia::create([
            'codigo' => 1000003,
            'nombre' => 'Química',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 2,
        ]);

        $data = [
            'codigo' => 1000003,
            'nombre' => 'Física',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El valor del campo codigo ya está en uso."
                        ]
                    ]
                ]);
    }
    public function test_store_validation_fails_when_nombre_is_too_long()
    {
        $data = [
            'codigo' => 1000002,
            'nombre' => str_repeat('a', 81),
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo nombre no debe contener más de 80 caracteres."
                        ]
                    ]
                ]);
    }
    public function test_store_validation_fails_with_non_integer_codigo()
    {
        $data = [
            'codigo' => 'texto_invalido',
            'nombre' => 'Física',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo codigo debe ser un número entero."
                        ]
                    ]
                ]);
    }
    public function test_store_validation_fails_when_nombre_is_not_string()
    {
        $data = [
            'codigo' => 1000006,
            'nombre' => 12345, 
            'tipo' => 'nombre', 
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo nombre debe ser una cadena de caracteres."
                        ]
                    ]
                ]);
    }


    public function test_store_validation_fails_when_tipo_is_not_string()
    {
        $data = [
            'codigo' => 1000006,
            'nombre' => "materia", 
            'tipo' => 1234567, 
            'nro_PeriodoAcademico' => 1,
        ];

        $response = $this->postJson('/api/materias', $data);

        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo tipo debe ser una cadena de caracteres."
                        ]
                    ]
                ]);
    }

    public function test_store_validation_fails_when_tipo_is_too_long()
    {
        $data = [
            'codigo' => 1000007,
            'nombre' => 'Matemáticas',
            'tipo' => str_repeat('a', 21), 
            'nro_PeriodoAcademico' => 1,
        ];
    
        $response = $this->postJson('/api/materias', $data);
    
        $response->assertStatus(422)
                ->assertJson([
                    "success" => false,
                    "data" => [],
                    "message" => "Error",
                    "error" => [
                        [
                            "status" => 422,
                            "detail" => "El campo tipo no debe contener más de 20 caracteres."
                        ]
                    ]
                ]);
    }
    

   
}
