<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

class AulaFactory extends Factory
{
    protected $model = Aula::class;

    public function definition()
    {
        return [
            'numero_aula' => $this->faker->unique()->numberBetween(1, 500),
            'capacidad' => $this->faker->numberBetween(20, 100),
            'habilitada' => $this->faker->boolean(),
            'id_ubicacion' => \App\Models\Ubicacion::factory(),
        ];
    }
}
