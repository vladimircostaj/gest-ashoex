<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre_edificio",
        "geolocalizacion",
    ];

    public function ubicacion(){
        return $this->hasMany(Ubicacion::class);
    }
}