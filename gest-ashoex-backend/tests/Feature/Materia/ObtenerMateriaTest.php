<?php

namespace Tests\Feature\Features\Materia;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use App\Models\Materia;
use Tests\TestCase;

class ObtenerMateriaTest extends TestCase
{
    use RefreshDatabase; // Esto asegura que la base de datos se limpie entre tests

    /**
     * Test que verifica que una materia existente se muestra correctamente.
     *
     * @return void
     */
    public function test_show_materia_existe()
    {
        $materia = Materia::create([
            'codigo' => '5448418',
            'nombre' => 'Algebra I',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => '3'
        ]);
        $response = $this->get("/api/materias/{$materia->id}");
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'success' => true,
                'error' => [],
                'message' => 'Operación exitosa',
                'data' => []
            ]);
    }

    /**
     * Test que verifica la respuesta cuando una materia no existe.
     *
     * @return void
     */
    public function test_show_materia_no_existe()
    {
        $response = $this->get("/api/materias/99");
        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => [
                    'La materia no existe',
                ],
                'message' => 'Operación fallida',
            ]);
    }
}
