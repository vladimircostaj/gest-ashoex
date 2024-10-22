<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Grupo;

class EliminarGrupoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_EliminarGrupo(): void
    {
        $grupo = Grupo::create([
            'materia_id' => 1,
            'nro_grupo' => rand(100, 999),
        ]);

        $id_grupo = $grupo->id;
        $response = $this->delete(uri: "/api/grupo/{$id_grupo}");

        $response->assertStatus(200);

         $this->assertDatabaseMissing('grupos', [
        'id' => $grupo->id,
    ]);
    }

    public function test_eliminar_grupo_no_existente(): void
    {
        $response = $this->delete("/api/grupo/999");

        $response->assertStatus(404);

        $response->assertJson([
        'success' => false,
        'message' => 'Grupo no encontrado',
        ]);
    }

}
