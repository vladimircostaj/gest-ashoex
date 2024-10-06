<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\PersonalAcademico; 

use Database\Seeders\DatabaseSeeder;

class PersonalAcademicoTest extends TestCase
{
    use RefreshDatabase; // limpia la base de datos con con cada llamada a los test
    
    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDarDeBajaPersonalExistente()
    {
        $personalAcademico = PersonalAcademico::factory()->create();
        $response = $this->patchJson('/api/personalAcademicos/'.$personalAcademico->id.'/dar-baja'); 
        $response->assertOk()
            ->assertJson([
                'message' => 'Se dio de baja correctamente al personal academico: '.$personalAcademico->nombre
            ]);
        $this->assertDatabaseHas(
            'personal_academicos', 
            [
                'id' => $personalAcademico->id, 
                'nombre' => $personalAcademico->nombre,
                'email' => $personalAcademico->email, 
                'estado' => config('constants.PERSONAL_ACADEMICO_ESTADOS')[1]
            ]
        );
        $response = $this->patchJson('/api/personalAcademicos/'.$personalAcademico->id.'/dar-baja'); 
        $response->assertStatus(428)
            ->assertJson([
                'message' => 'El personal academico: '.$personalAcademico->nombre.' ya fue dado de baja anteriormente, no puede dar de baja a un personal academico dado de baja.'
            ]);
    }
}
