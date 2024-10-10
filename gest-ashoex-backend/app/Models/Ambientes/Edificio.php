<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    protected $table = 'edificio';
    protected $primaryKey = 'id_edificio';
    protected $fillable = ['nombre_edificio', 'geolocalizacion'];

    public function ubicaciones()
    {
        return $this->hasMany(Ubicacion::class, 'id_edificio');
    }
}
