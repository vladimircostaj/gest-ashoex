<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';

    // Relación de muchos a uno: Una ubicación pertenece a un edificio
    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edificio');
    }

    // Relación de uno a muchos: Una ubicación tiene muchas aulas
    public function aulas()
    {
        return $this->hasMany(Aula::class, 'id_ubicacion');
    }
    use HasFactory;
}
