<?php

namespace Tests\Feature;

use App\Models\Edificio;
use App\Models\Ubicacion;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EdificioTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_edificios_devuelve_respuesta_exitosa(): void
    {
        $response = $this->get('/api/edificios');
        $response->assertStatus(200);
    }

    public function test_get_edificios_devuelve_formato_json(): void
    {
        Edificio::factory()->create();
        $response = $this->get('/api/edificios');
        $response->assertJsonStructure([['id_edificio', 'nombre_edificio', 'geolocalizacion', 'created_at', 'updated_at', 'ubicaciones']]);
    }
}
