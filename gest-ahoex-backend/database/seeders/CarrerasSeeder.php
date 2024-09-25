<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CarrerasSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('carreras')->insert([
            ['nombre' => 'Ingeniería de Sistemas'],
            ['nombre' => 'Ingeniería Industrial'],
            ['nombre' => 'Arquitectura'],
            ['nombre' => 'Ciencias de la Computación'],
            ['nombre' => 'Administración de Empresas'],
        ]);
    }
}