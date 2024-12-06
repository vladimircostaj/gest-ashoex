<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Materia;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MateriaUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Crear una materia inicial para usar en las pruebas
        Materia::create([
            'codigo' => 123,
            'nombre' => 'Materia de Prueba',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_updates_a_materia_successfully()
    {
        $materia = Materia::first();
        $this->assertEquals('Materia de Prueba', $materia->nombre);

        // Realiza una solicitud de actualización
        $response = $this->json('PUT', route('materiasUpdate.update', $materia->id), [
            'codigo' => $materia->codigo, // Mantener el código existente para evitar conflictos
            'nombre' => 'Materia Actualizada',
            'tipo' => 'taller de titulacion',
            'nro_PeriodoAcademico' => 2, // Asegúrate de que sea un entero mayor a 1
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         [
                             'id' => $materia->id,
                             'nombre' => 'Materia Actualizada',
                             'descripcion' => 'Materia actualizada.' // Asumimos que la descripción se establece
                         ]
                     ],
                     'error' => [],
                     'message' => 'Operación exitosa',
                 ]);

        // Verificar que la materia se ha actualizado en la base de datos
        $this->assertDatabaseHas('materias', [
            'id' => $materia->id,
            'nombre' => 'Materia Actualizada',
            'tipo' => 'taller de titulacion',
            'nro_PeriodoAcademico' => 2,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_returns_not_found_if_materia_does_not_exist()
    {
        $response = $this->json('PUT', route('materiasUpdate.update', 999), [
            'nombre' => 'Materia No Existente',
            'tipo' => 'taller de titulacion',
            'nro_PeriodoAcademico' => 1,
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'data' => [],
                     'error' => [
                         [
                             'code' => 404,
                             'detail' => 'Materia no encontrada',
                         ]
                     ],
                     'message' => 'Error',
                 ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_fields_before_update()
    {
        $materia = Materia::first();

        // Intentar actualizar con datos inválidos
        $response = $this->json('PUT', route('materiasUpdate.update', $materia->id), [
            'codigo' => 'texto_invalido', // Código debe ser un entero
            'nombre' => '',
            'tipo' => 'tipo invalido', // Tipo no permitido
            'nro_PeriodoAcademico' => 0, // Debe ser mayor a 0
        ]);

        $response->assertStatus(422); // Unprocessable Entity
        $response->assertJsonValidationErrors(['codigo', 'nombre', 'tipo', 'nro_PeriodoAcademico']);
    }
}
