<?php

namespace Database\Factories;

use App\Models\TipoPersonal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoPersonal>
 */
class TipoPersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TipoPersonal::class;
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
        ];
    }
}
