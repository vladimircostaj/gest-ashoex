<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AulaUsoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aula_uso')->insert([
            ['id_aula' => 1, 'id_uso' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 1, 'id_uso' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 2, 'id_uso' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 2, 'id_uso' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 3, 'id_uso' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 4, 'id_uso' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 5, 'id_uso' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 6, 'id_uso' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 7, 'id_uso' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 8, 'id_uso' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 9, 'id_uso' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 10, 'id_uso' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
