<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="PersonalAcademico",
 *     type="object",
 *     title="Personal Académico",
 *     description="Modelo que representa a un miembro del personal académico",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID único del personal académico",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="nombre",
 *         type="string",
 *         description="Nombre del personal académico",
 *         example="Juan Pérez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Correo electrónico del personal académico",
 *         example="juan.perez@example.com"
 *     ),
 *     @OA\Property(
 *         property="telefono",
 *         type="string",
 *         description="Número de teléfono del personal académico",
 *         example="+591123456789"
 *     ),
 *     @OA\Property(
 *         property="estado",
 *         type="string",
 *         description="Estado del personal académico",
 *         example="ACTIVO"
 *     ),
 *     @OA\Property(
 *         property="tipo_personal_id",
 *         type="integer",
 *         description="ID del tipo de personal académico",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="tipoPersonal",
 *         ref="#/components/schemas/TipoPersonal",
 *         description="Relación con el tipo de personal académico"
 *     )
 * )
 */
class PersonalAcademico extends Model
{
    use HasFactory;

    protected $table = 'personal_academicos';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'estado',
        'tipo_personal_id',
    ];

    /**
     * Relación con el modelo TipoPersonal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoPersonal()
    {
        return $this->belongsTo(TipoPersonal::class, 'tipo_personal_id');
    }

    /**
     * Dar de baja al personal académico.
     *
     * @return bool
     */
    public function darBaja(): bool
    {
        if ($this->estaDadoDeBaja()) {
            return false;
        } else {
            $this->estado = config('constants.PERSONAL_ACADEMICO_ESTADOS')[1];
            $this->save();
            return true;
        }
    }

    /**
     * Verifica si el personal académico ya está dado de baja.
     *
     * @return bool
     */
    private function estaDadoDeBaja(): bool
    {
        return $this->estado == config('constants.PERSONAL_ACADEMICO_ESTADOS')[1];
    }
}
