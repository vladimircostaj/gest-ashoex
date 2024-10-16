<?php

namespace Tests\Feature\Ambiente;

use App\Models\Uso;
use Tests\TestCase;

class UsoControllerTest extends TestCase
{
    public function testRegistrarUsoDeAmbiente(): void
    {
        $uso = [
            'tipo_uso' => 'Laboratorio',
            'id_aula' => 1
        ];

        $response = $this->postJson('/api/usos', $uso);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id_uso' => 1,
                    'tipo_uso' => $uso['tipo_uso'],
                    'id_aula' => $uso['id_aula']
                ],
                'error' => null,
                'message' => 'Tipo de uso registrado exitosamente',
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
                        'detail' => 'Debe ingresar un tipo de uso valido.'
                    ]
                ],
                'message' => 'Error',
            ]);
    }

    public function testActualizarUsoDeAmbiente(): void
    {
        $id_uso = 1;
        $uso = [
            'tipo_uso' => 'Aula Comun',
            'id_aula' => 1
        ];

        $response = $this->putJson("/api/usos/{$id_uso}", $uso);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id_uso' => 1,
                    'tipo_uso' => $uso['tipo_uso'],
                    'id_aula' => $uso['id_aula']
                ],
                'error' => null,
                'message' => 'Tipo de uso actualizado exitosamente',
            ]);
    }

    public function testActualizarUsoAmbienteConIdInvalido(): void
    {
        $id_uso = 999;
        $uso = [
            'tipo_uso' => '',
            'id_aula' => 1
        ];

        $response = $this->putJson("/api/usos/{$id_uso}", $uso);

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => [
                    [
                        'status' => 404,
                        'detail' => "No existe un Uso de ambiente con el ID: {$id_uso}"
                    ]
                ],
                'message' => 'Error',
            ]);
    }
}

