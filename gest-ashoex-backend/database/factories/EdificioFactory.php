<?php

namespace Database\Factories;

use App\Models\Edificio;
use Illuminate\Database\Eloquent\Factories\Factory;

class EdificioFactory extends Factory
{
    protected $model = Edificio::class;

    public function definition()
    {
        return [
            'nombre_edificio' => $this->faker->streetName(),
            'geolocalizacion' => $this->faker->address(),
        ];
    }
}
