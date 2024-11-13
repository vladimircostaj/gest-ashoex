<?php

namespace Database\Seeders\Ambientes;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AulaFacilidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('aula_facilidad')->insert([
            ['id_aula' => 1, 'id_facilidad' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 1, 'id_facilidad' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 2, 'id_facilidad' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 2, 'id_facilidad' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 3, 'id_facilidad' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 4, 'id_facilidad' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 5, 'id_facilidad' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 6, 'id_facilidad' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 7, 'id_facilidad' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 8, 'id_facilidad' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 9, 'id_facilidad' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id_aula' => 10, 'id_facilidad' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
