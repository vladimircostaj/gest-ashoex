<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'Carrera';
    protected $primaryKey = 'carrera_id';
    protected $fillable = ['nombre', 'nro_semestres'];

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'curriculas', 'carrera_id', 'materia_id');
    }

    use HasFactory;
}
