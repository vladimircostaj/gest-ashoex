<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Grupo;
use App\Models\Materia;

class EliminarGrupoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_EliminarGrupo(): void
    {
        $materia =Materia::create(
            ['codigo' => "123512331",
            'nombre' => 'Ingles I', 'tipo' => 'regular', 'nro_PeriodoAcademico' => 2],
        );
        $grupo = Grupo::create([
            'materia_id' => $materia->id,
            'nro_grupo' => rand(100, 999),
        ]);

        $id_grupo = $grupo->id;
        $response = $this->delete(uri: "/api/grupos/{$id_grupo}");
        
        $response->assertStatus(200);

         #$this->assertDatabaseMissing('grupos', [
        #'id' => $grupo->id,
    #]);
    }

    public function test_eliminar_grupo_no_existente(): void
    {
        $response = $this->delete("/api/grupos/999");

        $response->assertStatus(404);

        $response->assertJson([
        'success' => false,
        'message' => 'Grupo no encontrado',
        ]);
    }

}
