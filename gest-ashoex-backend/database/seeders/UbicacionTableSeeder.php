<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('ubicacion')->insert([
            ['piso' => 3, 'id_edificio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 4, 'id_edificio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 2, 'id_edificio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 5, 'id_edificio' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 3, 'id_edificio' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 2, 'id_edificio' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['piso' => 3, 'id_edificio' => 7, 'created_at' => now(), 'updated_at' => now()],
           
        ]);
    }
}

