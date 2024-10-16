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

    public function test_get_edificio_individual_devuelve_el_recurso_correcto(): void
    {
        $edificio = Edificio::factory()->create();
        $response = $this->get("/api/edificios/{$edificio->id_edificio}");
        $response->assertStatus(200)->assertJson(['id_edificio' => $edificio->id_edificio]);
    }

    public function test_post_edificio_crea_nuevo_recurso(): void
    {
        $data = ['nombre_edificio' => 'Nuevo Edificio', 'geolocalizacion' => 'Centro'];
        $response = $this->post('/api/edificios', $data);
        $response->assertStatus(201)->assertJsonFragment($data);
    }

    public function test_post_edificio_falla_con_datos_no_validos(): void
    {
        $response = $this->post('/api/edificios', ['nombre_edificio' => '']);
        $response->assertStatus(422);
    }

    public function test_put_edificio_recursos_de_actualizacion(): void
    {
        $edificio = Edificio::factory()->create();
        $data = ['nombre_edificio' => 'Edificio Actualizado'];
        $response = $this->put("/api/edificios/{$edificio->id_edificio}", $data);
        $response->assertStatus(200)->assertJsonFragment($data);
    }

    public function test_put_edificio_falla_con_datos_invalidos(): void
    {
        $edificio = Edificio::factory()->create();
        $response = $this->put("/api/edificios/{$edificio->id_edificio}", ['nombre_edificio' => '']);
        $response->assertStatus(422);
    }
}
