<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarreraControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creacionCarrera()
    {
        $data = [
            'nombre' => 'Licenciatura en Ingeniería Eléctrica',
            'nro_semestres' => 11,
        ];
        $response = $this->postJson('/api/carreras', $data);

        $response->assertStatus(201);

        $response->assertJson([
            'success' => true,
            'data' => [
                [
                    'nombre' => 'Licenciatura en Ingeniería Eléctrica',
                    'nro_semestres' => 11,
                ]
            ],
            'error' => [],
            'message' => 'Operación exitosa'
        ]);

        $this->assertArrayHasKey('id', $response['data'][0]);

        $this->assertDatabaseHas('carreras', [
            'nombre' => 'Licenciatura en Ingeniería Eléctrica',
            'nro_semestres' => 11,
        ]);
    }

    /** @test */
    public function erroresValidacionFormatoCorrecto()
    {
        $data = [
            'nombre' => '',
            'nro_semestres' => 13
        ];

        $response = $this->postJson('/api/carreras', $data);

        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nombre es obligatorio.'
                ],
                [
                    'status' => 422,
                    'detail' => 'El campo nro semestres no debe ser mayor a 12.'
                ]
            ],
            'message' => 'Error',
        ]);
    }

    /** @test */
    public function erroresValidacionNombreNumerico()
    {
        $data = [
            'nombre' => 1,
            'nro_semestres' => 10
        ];

        $response = $this->postJson('/api/carreras', $data);

        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nombre debe ser una cadena de caracteres.'
                ]
            ],
            'message' => 'Error',
        ]);
    }

    /** @test */
    public function erroresValidacionNombreArray()
    {
        $data = [
            'nombre' => ["Ingeniería de sistemas", "Ingeniería informática"],
            'nro_semestres' => 10
        ];

        $response = $this->postJson('/api/carreras', $data);

        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nombre debe ser una cadena de caracteres.'
                ]
            ],
            'message' => 'Error',
        ]);
    }

    /** @test */
    public function erroresValidacionNombreBooleano()
    {
        $data = [
            'nombre' => true,
            'nro_semestres' => 10
        ];

        $response = $this->postJson('/api/carreras', $data);

        $response->assertStatus(422);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nombre debe ser una cadena de caracteres.'
                ]
            ],
            'message' => 'Error',
        ]);
    }

    /** @test */
    public function controlCreacionCarreraDuplicada()
    {
        $data = [
            'nombre' => "Licenciatura en Ingeniería de Sistemas",
            'nro_semestres' => 10
        ];

        $response = $this->postJson('/api/carreras', $data);
        $response = $this->postJson('/api/carreras', $data);

        $response->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El valor del campo nombre ya está en uso.'
                ]
            ],
            'message' => 'Error',
        ]);
    }
}
