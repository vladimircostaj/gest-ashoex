<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curricula extends Model
{
    use HasFactory;

    protected $fillable = ['carrera_id', 'materia_id', 'nivel', 'electiva'];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
