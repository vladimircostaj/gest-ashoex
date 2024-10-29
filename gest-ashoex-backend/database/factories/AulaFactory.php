<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Ubicacion;
use App\Models\Uso;
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
            'id_ubicacion' => Ubicacion::factory(),
            'id_uso' => Uso::factory(),
        ];
    }
}
