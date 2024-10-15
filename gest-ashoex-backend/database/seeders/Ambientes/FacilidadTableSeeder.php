<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilidadTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('facilidad')->insert([
            ['nombre_facilidad' => 'Pizarra', 'id_aula' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Proyector', 'id_aula' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Parlantes', 'id_aula' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Aire Acondicionado', 'id_aula' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Pizarras Interactivas', 'id_aula' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Proyector', 'id_aula' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Equipo de Sonido', 'id_aula' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Micrófonos', 'id_aula' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Sillas Acolchonadas', 'id_aula' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Cámaras de Video', 'id_aula' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
