<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TipoPersonal;
use App\Models\PersonalAcademico;

class PersonalAcademicoControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_show_personal_academico()
    {
        $tipoPersonal = TipoPersonal::factory()->create();
        $personalAcademico = PersonalAcademico::factory()->create([
            'tipo_personal_id' => $tipoPersonal->id,
        ]);

        $response = $this->getJson("/api/personal/{$personalAcademico->id}/informacion");
        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $personalAcademico->id,
            'name' => $personalAcademico->name,
            'telefono' => $personalAcademico->telefono,
            'estado' => $personalAcademico->estado,
        ]);

        //'tipoPersonal' => [
          //      'id' => $tipoPersonal->id,
        //],

        
    }
}
