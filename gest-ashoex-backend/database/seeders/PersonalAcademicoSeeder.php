<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Factories\PersonalAcademicoFactory;

use App\Models\PersonalAcademico; 

class PersonalAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalAcademico::factory()->count(20)->create();
    }
}
