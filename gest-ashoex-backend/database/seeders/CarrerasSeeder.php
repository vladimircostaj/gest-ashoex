<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carreras')->insert([
            [
                'nombre' => 'Ingeniería de Sistemas',
                'nro_semestres' => 10,
            ],
            [
                'nombre' => 'Ingeniería Industrial',
                'nro_semestres' => 10,
            ],
            [
                'nombre' => 'Arquitectura',
                'nro_semestres' => 12,
            ],
            [
                'nombre' => 'Ciencias de la Computación',
                'nro_semestres' => 8,
            ],
            [
                'nombre' => 'Administración de Empresas',
                'nro_semestres' => 8,
            ],
        ]);
    }
}

