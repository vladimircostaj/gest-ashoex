<?php

namespace Database\Factories\Ambientes;

use App\Models\Ambientes\Facilidad;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilidadFactory extends Factory
{
    protected $model = Facilidad::class;

    public function definition()
    {
        return [
            'nombre_facilidad' => $this->faker->word(),
        ];
    }
}
