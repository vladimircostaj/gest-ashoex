<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';
    protected $fillable = ['piso', 'id_edificio'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edificio');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'id_ubicacion');
    }
}
