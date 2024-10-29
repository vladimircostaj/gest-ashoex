<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PersonalAcademico;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonalAcademicoUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_404_if_personal_academico_not_found_on_update()
    {
        $data = [
            'nombre' => 'Nombre Actualizado',
            'email' => 'actualizado@example.com',
            'telefono' => '111222333',
            'estado' => 'activo',
            'tipo_personal_id' => 1,
        ];

        $response = $this->putJson('/api/personal-academico/999', $data);  // ID inexistente
        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Error en la solicitud.',
                     'error' => [['code' => 404, 'message' => 'Personal académico no encontrado.']],
                 ]);
    }

    /** @test */
    public function it_returns_409_if_email_is_already_taken_on_update()
    {
        $existingUser = PersonalAcademico::factory()->create(['email' => 'taken@example.com']);
        $personalAcademico = PersonalAcademico::factory()->create();

        $data = [
            'nombre' => 'Nuevo Nombre',
            'email' => 'taken@example.com',  // Email ya registrado
            'telefono' => '123456789',
            'estado' => 'activo',
            'tipo_personal_id' => $personalAcademico->tipo_personal_id,
        ];

        $response = $this->putJson("/api/personal-academico/{$personalAcademico->id}", $data);
        $response->assertStatus(409)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Error en la solicitud.',
                     'error' => [['code' => 409, 'message' => 'El correo electrónico ya está registrado.']],
                 ]);
    }

    /** @test */
    public function it_returns_400_for_invalid_input_on_update()
    {
        $personalAcademico = PersonalAcademico::factory()->create();

        // Datos faltantes o inválidos
        $data = [
            'nombre' => '',  // Campo requerido
            'email' => 'correo-no-valido',  // Formato incorrecto
            'telefono' => '123456789',
            'estado' => 'activo',
            'tipo_personal_id' => 999,  // ID de tipo personal no existente
        ];

        $response = $this->putJson("/api/personal-academico/{$personalAcademico->id}", $data);
        $response->assertStatus(400)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Error en la solicitud.',
                     'error' => [['code' => 400, 'message' => 'Datos de entrada inválidos.']],
                 ]);
    }

    /** @test */
    public function it_updates_personal_academico_successfully()
    {
        $personalAcademico = PersonalAcademico::factory()->create();

        $data = [
            'nombre' => 'Nombre Actualizado',
            'email' => 'actualizado@example.com',
            'telefono' => '111222333',
            'estado' => 'activo',
            'tipo_personal_id' => $personalAcademico->tipo_personal_id,
        ];

        $response = $this->putJson("/api/personal-academico/{$personalAcademico->id}", $data);
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Operación exitosa.',
                     'data' => [
                         'id' => $personalAcademico->id,
                         'nombre' => 'Nombre Actualizado',
                         'email' => 'actualizado@example.com',
                     ],
                 ]);
    }
}
