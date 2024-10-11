<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ListaPersonalAcademicoController;

class ListaPersonalAcademicoTest extends TestCase
{
    public function test_lista_personal_academico_devuelve_datos_correctos()
    {
        // Simulación de datos que debería devolver
        $expectedData = [
            (object)[
                'Tipo_personal' => 'Docente',
                'telefono' => '123456789',
                'personal_academico_id' => 1,
                'tipo_personal_id' => 1,
                'name' => 'Juan Perez',
                'email' => 'juan.perez@example.com',
                'estado' => 'activo'
            ],
            (object)[
                'Tipo_personal' => 'Administrativo',
                'telefono' => '987654321',
                'personal_academico_id' => 2,
                'tipo_personal_id' => 2,
                'name' => 'Ana Gomez',
                'email' => 'ana.gomez@example.com',
                'estado' => 'inactivo'
            ]
        ];

        
        DB::shouldReceive('table->join->select->get')
            ->once()
            ->andReturn(collect($expectedData));

        $controller = new ListaPersonalAcademicoController();
        $response = $controller->ListaPersonalAcademico();

    
        $actualData = $response->getData();


        $this->assertEquals($expectedData, $actualData);
    }
}
