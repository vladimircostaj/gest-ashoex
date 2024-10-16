<?php

namespace Database\Factories;

use App\Models\Ubicacion;
use App\Models\Edificio;
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
