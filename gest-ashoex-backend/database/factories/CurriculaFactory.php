<?php

namespace Database\Factories;

use App\Models\Curricula;
use App\Models\Carrera;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculaFactory extends Factory
{
    protected $model = Curricula::class;

    public function definition()
    {
        return [
            'carrera_id' => Carrera::factory(),
            'materia_id' => Materia::factory(),
            'nivel' => $this->faker->numberBetween(1, 8),
            'electiva' => $this->faker->boolean,
        ];
    }
}