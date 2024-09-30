<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'materia_id',
        'nro_grupo'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
