<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'Carrera';
    protected $primaryKey = 'materia_id';
    protected $fillable = ['nombre', 'curricula_id', 'tipo', 'nro_PeriodoAcademico'];

    public function curricula()
    {
        return $this->belongsTo(Curricula::class);
    }
    use HasFactory;
}
