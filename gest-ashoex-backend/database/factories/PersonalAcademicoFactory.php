<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PersonalAcademico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalAcademico>
 */
class PersonalAcademicoFactory extends Factory
{

    protected $model = PersonalAcademico::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'tipo_personal_id' => \App\Models\TipoPersonal::factory(), // Relacionamos con TipoPersonal
        ];
    }
}
