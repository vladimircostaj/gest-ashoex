<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EdificioTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('edificio')->insert([
            ['nombre_edificio' => 'Edificio Nuevo', 'geolocalizacion' => '16.508,-68.161', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Multiacademico', 'geolocalizacion' => '16.510,-68.162', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Memi', 'geolocalizacion' => '16.512,-68.163', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Sistemas', 'geolocalizacion' => '16.514,-68.164', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Laboratorios', 'geolocalizacion' => '16.516,-68.165', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Industrial', 'geolocalizacion' => '16.518,-68.166', 'created_at' => now(), 'updated_at' => now()],
            ['nombre_edificio' => 'Edificio Fisica', 'geolocalizacion' => '16.520,-68.167', 'created_at' => now(), 'updated_at' => now()],
            
        ]);
    }
}
