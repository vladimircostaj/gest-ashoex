<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TipoPersonal;

class TipoPersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoPersonal::create(['nombre' => 'DOCENTE']);
        TipoPersonal::create(['nombre' => 'AUXILIAR']);
    }
}
