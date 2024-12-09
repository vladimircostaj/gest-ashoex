<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="TipoPersonal",
 *     type="object",
 *     title="Tipo de Personal",
 *     description="Modelo que representa los diferentes tipos de personal académico",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID único del tipo de personal",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del tipo de personal",
 *         example="Profesor"
 *     )
 * )
 */
class TipoPersonal extends Model
{
    use HasFactory;

    protected $table = 'tipo_personals';
    protected $fillable = ['nombre'];

    /**
     * Relación con el modelo PersonalAcademico.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personalAcademicos()
    {
        return $this->hasMany(PersonalAcademico::class);
    }
}
