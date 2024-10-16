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
}
