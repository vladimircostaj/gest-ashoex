<?php

namespace Tests\Feature\Ambiente;

use App\Models\Ambientes\Edificio;
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
        $response->assertJsonStructure([
            'success', 'data', 'error', 'message'
        ]);
    }

    public function test_get_edificio_individual_devuelve_el_recurso_correcto(): void
    {
        $edificio = Edificio::factory()->create();
        $response = $this->get("/api/edificios/{$edificio->id_edificio}");
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id_edificio' => $edificio->id_edificio,
                    'nombre_edificio' => $edificio->nombre_edificio,
                    'geolocalizacion' => $edificio->geolocalizacion,
                    'ubicaciones' => []
                ],
                'error' => null,
                'message' => 'Edificio recuperado exitosamente',
            ]);
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

    public function test_delete_edificio_elimina_recurso(): void
    {
        $edificio = Edificio::factory()->create();
        $response = $this->delete("/api/edificios/{$edificio->id_edificio}");
        $response->assertStatus(204);
    }

    public function test_delete_edificio_inexistente_returns_404(): void
    {
        $response = $this->delete('/api/edificios/99999');
        $response->assertStatus(404);
    }

    public function test_delete_edificio_satisfactoriamente(): void
    {
        $edificio = Edificio::factory()->create();
        $response = $this->delete("/api/edificios/{$edificio->id_edificio}");
        $response->assertStatus(204);
    }

    public function test_delete_edificio_no_existente_retorna_404(): void
    {
        $response = $this->delete('/api/edificios/999');
        $response->assertStatus(404);
    }
}
