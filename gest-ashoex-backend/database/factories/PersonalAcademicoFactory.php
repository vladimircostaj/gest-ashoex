<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\TipoPersonal;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalAcademico>
 */
class PersonalAcademicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // esto es para saber los id's actuales de TipoPersonal, aun falta su refactorizacion. esto sirve para poder generar datos de tipo_personal_id con falsos para los tests con PHPUnit. 
        $tipoPersonalIds = TipoPersonal::pluck('id')->toArray();
        if (empty($tipoPersonalIds)) {
            throw new \Exception('no existen tipos de personal');
        }
        return [
            'nombre' => $this->faker->name(), 
            'email' => $this->faker->safeEmail(), 
            'telefono' => '+591'.$this->faker->numerify('########'),
            'tipo_personal_id' => $this->faker->randomElement($tipoPersonalIds),
        ];
    }
}
