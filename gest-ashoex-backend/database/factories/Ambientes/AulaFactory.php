<?php

namespace Database\Factories\Ambientes;

use App\Models\Ambientes\Aula;
use App\Models\Ambientes\Ubicacion;
use App\Models\Ambientes\Uso;
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
        ];
    }
}
