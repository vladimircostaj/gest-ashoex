<?php

namespace Database\Factories\Ambientes;

use App\Models\Ambientes\Uso;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsoFactory extends Factory
{
    protected $model = Uso::class;

    public function definition()
    {
        return [
            'tipo_uso' => $this->faker->word(),
        ];
    }
}
