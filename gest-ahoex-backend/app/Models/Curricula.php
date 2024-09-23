<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curricula extends Model
{
    use HasFactory;
    protected $table = 'Curricula';
    protected $primaryKey = 'curricula_id';
    protected $fillable = ['nombre', 'carrera_id'];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }
    use HasFactory;
}
