<?php

namespace Database\Factories\Ambientes;

use App\Models\Ambientes\Ubicacion;
use App\Models\Ambientes\Edificio;
use Illuminate\Database\Eloquent\Factories\Factory;

class UbicacionFactory extends Factory
{
    protected $model = Ubicacion::class;

    public function definition()
    {
        return [
            'piso' => $this->faker->numberBetween(1, 10),
            'id_edificio' => Edificio::factory(),
        ];
    }
}
