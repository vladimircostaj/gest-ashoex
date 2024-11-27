<?php

namespace Tests\Feature;

use App\Models\Ambientes\Aula;
use App\Models\Ambientes\Edificio;
use App\Models\Ambientes\Ubicacion;
use App\Models\Ambientes\Uso;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyAulaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que se pueda eliminar un aula existente.
     */
    public function testEliminarAulaExistente(): void
    {

        $edificio = Edificio::create([
            'nombre_edificio' => 'edificio 1'
        ]);

        $ubicacion = Ubicacion::create([
            'piso' => 1,
            'id_edificio' => $edificio->id_edificio
        ]);

        $uso = Uso::create([
            'tipo_uso' => 'examen'
        ]);

        $aula = Aula::create([
            'numero_aula' => 'Aula 101',
            'capacidad' => 30,
            'id_ubicacion' => $ubicacion->id_ubicacion,
            'id_uso' => $uso->id_uso
        ]);

        $response = $this->deleteJson('/api/aulas/' . $aula->id_aula);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [],
                'error' => [],
                'message' => 'Operación exitosa',
            ]);

        $this->assertDatabaseMissing('aula', ['id_aula' => $aula->id_aula]);
    }

    /**
     * Prueba que no se pueda eliminar un aula inexistente.
     */
    public function testEliminarAulaInexistente(): void
    {
        $idNoExistente = 999;

        $response = $this->deleteJson('/api/aulas/' . $idNoExistente);

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'data' => [],
                'error' => 'Aula no encontrada',
                'message' => 'Operación fallida',
            ]);
    }
}
