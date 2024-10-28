<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Materia;

class EliminarMateriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_deletes_materia_successfully()
    {
        // Crear una materia en la base de datos
        $materia = Materia::create([
            'codigo' => 1000003,
            'nombre' => 'Matemáticas Avanzadas',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 3,
        ]);

        // Realizar la petición DELETE para eliminar la materia
        $response = $this->deleteJson("/api/materias/{$materia->id}");

        // Verificar que la respuesta tenga estado 200 (OK)
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Operación exitosa',
                     'data' => [],
                     'error' => [],
                 ]);

        // Verificar que la materia fue eliminada de la base de datos
        $this->assertDatabaseMissing('materias', ['id' => $materia->id]);
    }

    public function test_destroy_returns_not_found_when_materia_does_not_exist()
    {
        // Realizar la petición DELETE para un ID inexistente
        $response = $this->deleteJson("/api/materias/999");

        // Verificar que la respuesta tenga estado 404 (No encontrado)
        $response->assertStatus(Response::HTTP_NOT_FOUND)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Error',
                     'data' => [],
                     'error' => [
                         [
                             'code' => Response::HTTP_NOT_FOUND,
                             'detail' => 'Materia no encontrada',
                         ]
                     ],
                 ]);
    }
}