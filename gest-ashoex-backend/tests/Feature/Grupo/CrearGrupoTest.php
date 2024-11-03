<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Grupo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use App\Models\Materia;
class CrearGrupoTest extends TestCase
{
    
    use RefreshDatabase;
    public function test_crear_nuevo_grupo()
    {
        
        $materia = Materia::create([
            'codigo' => 123456,
            'nombre' => 'Algoritmos Avanzados',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1
        ]);

        $data = [
            'materia_id' => $materia->id,
            'nro_grupo' => 2,
        ];

        $response = $this->postJson('/api/grupos', $data);
        #dd($response);
       
        $response->assertStatus(201);

       
        $this->assertDatabaseHas('grupos', $data);
    }
    public function test_crear_nuevo_grupo_grupo_negativo()
{
    $materia = Materia::create([
        'codigo' => 123456,
        'nombre' => 'Algoritmos Avanzados',
        'tipo' => 'regular',
        'nro_PeriodoAcademico' => 1
    ]);
    $data = [
        'materia_id' => $materia->id,
        'nro_grupo' => -3,
    ];


    $response = $this->postJson('/api/grupos', $data);

    $response->assertStatus(422);

    $this->assertDatabaseMissing('grupos', $data);
}
public function test_crear_nuevo_grupo_sin_materia()
{
    
    $data = [
        'nro_grupo' => 3
    ];


    $response = $this->postJson('/api/grupos', $data);

    $response->assertStatus(422);

    $this->assertDatabaseMissing('grupos', $data);
}


public function test_crear_nuevo_grupo_sin_grupo()
{
    $materia = Materia::create([
        'codigo' => 123456,
        'nombre' => 'Algoritmos Avanzados',
        'tipo' => 'regular',
        'nro_PeriodoAcademico' => 1
    ]);
    $data = [
        'materia_id' => $materia->id
    ];


    $response = $this->postJson('/api/grupos', $data);

    $response->assertStatus(422);

    $this->assertDatabaseMissing('grupos', $data);
}

public function test_crear_nuevo_grupo_materia_no_existe()
{
    
    $data = [
        'materia_id' => 10,
        'nro_grupo' => 3,
    ];


    $response = $this->postJson('/api/grupos', $data);

    $response->assertStatus(422);

    $this->assertDatabaseMissing('grupos', $data);
}



public function test_crear_grupo_existente()
{

    $materia = Materia::create([
        'codigo' => 123456,
        'nombre' => 'Algoritmos Avanzados',
        'tipo' => 'regular',
        'nro_PeriodoAcademico' => 1
    ]);

    $data = [
        'materia_id' => $materia->id,
        'nro_grupo' => 2,
    ];
    

    $data = [
        'materia_id' => $materia->id,
        'nro_grupo' => 2,
    ];

     Grupo::create($data);

     $response = $this->postJson('/api/grupos', $data);

     $response->assertStatus(409);

    $this->assertDatabaseCount('grupos', 1);
}
}