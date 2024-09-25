<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';

    protected $fillable = [
        "piso",
        "edificio_id"
    ];

    public function ambiente(){
        return $this->hasMany(Ambiente::class);
    }

    public function edificio(){
        return $this->belongsTo(Edificio::class);
    }
}
