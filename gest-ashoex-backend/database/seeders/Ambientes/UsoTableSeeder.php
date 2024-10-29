<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('uso')->insert([
            ['tipo_uso' => 'Clases', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Conferencia', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Seminarios', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Reuniones', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Laboratorio de computacion', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Defensa de Tesis', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Talleres', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Laboratorio de mecanica', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Laboratorio de matematica', 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Laboratorio de fisica', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
