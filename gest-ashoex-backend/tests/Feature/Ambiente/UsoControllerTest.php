<?php

namespace Tests\Feature\Ambiente;

use App\Models\Ambientes\Uso;
use Tests\TestCase;

class UsoControllerTest extends TestCase
{
    public function testRegistrarUsoDeAmbiente(): void
    {
        $uso = [
            'tipo_uso' => 'Laboratorio',
        ];

        $response = $this->postJson('/api/usos', $uso);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'tipo_uso' => $uso['tipo_uso'],

                ],
                'error' => null,
                'message' => 'Uso registrado exitosamente',
            ]);
    }

    public function testRegistrarUsoDeAmbienteConCampoTipoUsoEnBlanco(): void
    {
        $uso = [
            'tipo_uso' => '',
            'id_aula' => 1
        ];

        $response = $this->postJson('/api/usos', $uso);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => [
                    [
                        'status' => 422,
                        'detail' => 'Debe ingresar un tipo de uso válido.'
                    ]
                ],
                'message' => 'Error',
            ]);
    }

    public function testActualizarUsoDeAmbiente(): void
    {

        $uso = Uso::factory()->create();
        $data = [
            'tipo_uso' => "Auditorio",

        ];

        $response = $this->putJson("/api/usos/{$uso -> id_uso}",$data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id_uso' => $uso -> id_uso,
                    'tipo_uso' => $data['tipo_uso'],
                ],
                'error' => null,
                'message' => 'Uso actualizado exitosamente',
            ]);
    }

    public function testActualizarUsoAmbienteConIdInvalido(): void
    {
        $data = [
            'tipo_uso' => 'Sala de Conferencias',

        ];

        $response = $this->putJson('/api/usos/-1', $data); // ID que no existe

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => 'Uso de ambiente no encontrado',
                'message' => ''
            ]);
    }
}

