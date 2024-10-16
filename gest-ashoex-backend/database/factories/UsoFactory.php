<?php

namespace Database\Factories;

use App\Models\Uso;
use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsoFactory extends Factory
{
    protected $model = Uso::class;

    public function definition()
    {
        return [
            'tipo_uso' => $this->faker->word(),
            'id_aula' => Aula::factory(),
        ];
    }
}
