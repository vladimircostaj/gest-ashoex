<?php

namespace Database\Factories;

use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\Factory;

class MateriaFactory extends Factory
{
    protected $model = Materia::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'nombre' => $this->faker->word,
            'tipo' => $this->faker->randomElement(['regular', 'electiva']),
            'nro_PeriodoAcademico' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}