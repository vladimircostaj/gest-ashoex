<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilidadTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('facilidad')->insert([
            ['nombre_facilidad' => 'Pizarra', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Proyector', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Parlantes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Aire Acondicionado', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Pizarras Interactivas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Equipo de Sonido', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Micrófonos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Sillas Acolchonadas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_facilidad' => 'Cámaras de Video', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
