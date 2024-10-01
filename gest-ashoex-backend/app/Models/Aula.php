<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $primaryKey = 'id_aula';

    // Relación de muchos a uno: Un aula pertenece a una ubicación
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    // Relación de uno a muchos: Un aula tiene muchos usos
    public function usos()
    {
        return $this->hasMany(Uso::class, 'id_aula');
    }

    // Relación de uno a muchos: Un aula tiene muchas facilidades
    public function facilidades()
    {
        return $this->hasMany(Facilidad::class, 'id_aula');
    }
    use HasFactory;
}
