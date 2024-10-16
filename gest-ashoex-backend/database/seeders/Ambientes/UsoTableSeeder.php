<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('uso')->insert([
            ['tipo_uso' => 'Clases', 'id_aula' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Conferencia', 'id_aula' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Seminarios', 'id_aula' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Reuniones', 'id_aula' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'LAboratorio de computacion', 'id_aula' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Defensa de Tesis', 'id_aula' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['tipo_uso' => 'Talleres', 'id_aula' => 7, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
