<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TipoPersonal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoPersonal>
 */
class TipoPersonalFactory extends Factory
{
    protected $model = TipoPersonal::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(['Docente']),
        ];
    }
}
