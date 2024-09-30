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
        $a = TipoPersonal::all()->map(function($tipoPersonal) {
            return $tipoPersonal->id;
        })->toArray();
        $x = min($a[0], $a[1]); 
        $y = max($a[0], $a[1]);
        return [
            'nombre' => $this->faker->name(), 
            'email' => $this->faker->safeEmail(), 
            'telefono' => '+591'.$this->faker->numerify('########'),
            'tipo_personal_id' => $this->faker->numberBetween($x, $y),
        ];
    }
}
