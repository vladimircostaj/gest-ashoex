<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AulaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('aula')->insert([
            ['numero_aula' => '693 A', 'capacidad' => 100, 'habilitada' => true, 'id_ubicacion' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '693 B', 'capacidad' => 100, 'habilitada' => true, 'id_ubicacion' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '693 C', 'capacidad' => 150, 'habilitada' => true, 'id_ubicacion' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => 'Labo 4', 'capacidad' => 30, 'habilitada' =>  true, 'id_ubicacion' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '681 F', 'capacidad' => 35, 'habilitada' => true, 'id_ubicacion' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '681 J', 'capacidad' => 45, 'habilitada' => true, 'id_ubicacion' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '618', 'capacidad' => 20, 'habilitada' => true, 'id_ubicacion' => 8,  'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '619', 'capacidad' => 50, 'habilitada' => true, 'id_ubicacion' => 8,  'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '402', 'capacidad' => 45, 'habilitada' => true, 'id_ubicacion' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['numero_aula' => '617 A', 'capacidad' => 60, 'habilitada' => true, 'id_ubicacion' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
