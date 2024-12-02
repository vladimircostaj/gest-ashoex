<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Http\Response;

class EditarGrupoTest extends TestCase
{
    use RefreshDatabase;


    public function test_actualizar_grupo_correctamente()
    {
        $materia = Materia::create([
            'codigo' => 1000001,
            'nombre' => 'Ingles I',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        $grupo = Grupo::create([
            'materia_id' => $materia->id,
            'nro_grupo' => 1,
        ]);

        $response = $this->putJson('/api/grupos/' . $grupo->id, [
            'materia_id' => $materia->id,
            'nro_grupo' => 2
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'data' => [
                [
                    'id' => $grupo->id,
                    'materia_id' => $materia->id,
                    'nro_grupo' => 2,
                    'descripcion' => 'Grupo actualizado'
                ]
            ],
            'error' => [],
            'message' => 'Operación exitosa'
        ]);

        $this->assertDatabaseHas('grupos', [
            'id' => $grupo->id,
            'materia_id' => $materia->id,
            'nro_grupo' => 2
        ]);
    }

    public function test_grupo_no_existe()
    {
        $materia = Materia::create([
            'codigo' => 1000101,
            'nombre' => 'Algebra',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 2,
        ]);

        $grupoId = 99999; //se asigna un id que no este en la BD

        $response = $this->putJson('/api/grupos/' . $grupoId, [
            'materia_id' => $materia->id, 
            'nro_grupo' => 2  
        ]);

        $response->assertStatus(404);
        $response->assertJson([
            'success' => false,
            'error' => [
                [
                    'detail' => 'Grupo no encontrado'
                ]
            ]
        ]);
    }

    public function test_grupos_duplicados()
    {
        $materia = Materia::create([
            'codigo' => 1100001,
            'nombre' => 'Ingles II',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);

        $grupo1 = Grupo::create([
            'materia_id' => $materia->id,
            'nro_grupo' => 1,
        ]);

        $grupo2 = Grupo::create([
            'materia_id' => $materia->id,
            'nro_grupo' => 2,
        ]);

        $grupoId = $grupo2->id;
        $response = $this->putJson('/api/grupos/' . $grupoId, [
            'materia_id' => $materia->id,
            'nro_grupo' => 1 
        ]);

        $response->assertStatus(409);
        $response->assertJson([
            'success' => false,
            'error' => [
                        'code' => 409,
                        'detail' => 'Ya existe un grupo con este número en la misma materia'
                       ]
        ]);
    }

    public function test_campos_nulos()
    {
        $materia = Materia::create([
            'codigo' => 1100001,
            'nombre' => 'Ingles II',
            'tipo' => 'regular',
            'nro_PeriodoAcademico' => 1,
        ]);
    
        $grupo = Grupo::create([
            'materia_id' => $materia->id,
            'nro_grupo' => 1,
        ]);
    
        $grupoId = $grupo->id;
    
        $responseNull = $this->putJson('/api/grupos/' . $grupoId, [
            'materia_id' => $materia->id,
            'nro_grupo' => null // Caso 1: valor null
        ]);
    
        $responseNull->assertStatus(422);
        $responseNull->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nro grupo es obligatorio.'
                ]
            ],
            'message' => 'Error'
        ]);
    
        $responseEmpty = $this->putJson('/api/grupos/' . $grupoId, [
            'materia_id' => $materia->id,
            'nro_grupo' => '' // Caso 2: vacío
        ]);
    
        $responseEmpty->assertStatus(422);
        $responseEmpty->assertJson([
            'success' => false,
            'data' => [],
            'error' => [
                [
                    'status' => 422,
                    'detail' => 'El campo nro grupo es obligatorio.'
                ]
            ],
            'message' => 'Error'
        ]);
    }
}
