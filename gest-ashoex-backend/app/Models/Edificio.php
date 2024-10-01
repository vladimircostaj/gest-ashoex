<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    protected $table = 'edificio';
    protected $primaryKey = 'id_edificio';

    // Relación de uno a muchos: Un edificio tiene muchas ubicaciones
    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class, 'id_edificio');
    }
    use HasFactory;
}
