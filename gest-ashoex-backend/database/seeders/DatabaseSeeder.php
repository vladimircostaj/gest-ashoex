<?php

namespace Database\Seeders;

use Database\Seeders\Ambientes\AulaFacilidadTableSeeder;
use Database\Seeders\Ambientes\AulaTableSeeder;
use Database\Seeders\Ambientes\EdificioTableSeeder;
use Database\Seeders\Ambientes\FacilidadTableSeeder;
use Database\Seeders\Ambientes\UbicacionTableSeeder;
use Database\Seeders\Ambientes\UsoTableSeeder;
use Database\Seeders\Ambientes\AulaUsoTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(EdificioTableSeeder::class);
        $this->call(UbicacionTableSeeder::class);
        $this->call(UsoTableSeeder::class);
        $this->call(AulaTableSeeder::class);
        $this->call(FacilidadTableSeeder::class);
        $this->call(AulaFacilidadTableSeeder::class);
        $this->call(AulaUsoTableSeeder::class);
    }
}
