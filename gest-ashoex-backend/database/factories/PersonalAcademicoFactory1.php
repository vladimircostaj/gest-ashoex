<?php

namespace Database\Factories;

use App\Models\PersonalAcademico;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonalAcademicoFactory2 extends Factory
{
    protected $model = PersonalAcademico::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'estado' => 'activo',
            'tipo_personal_id' => 1,  // Asegúrate de ajustar este valor según tus datos de prueba
        ];
    }
}
