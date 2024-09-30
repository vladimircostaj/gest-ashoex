<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'Materia';
    protected $primaryKey = 'materia_id';
    protected $fillable = ['nombre', 'tipo', 'nro_PeriodoAcademico'];

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'curriculas', 'materia_id', 'carrera_id');
    }

    use HasFactory;
}
