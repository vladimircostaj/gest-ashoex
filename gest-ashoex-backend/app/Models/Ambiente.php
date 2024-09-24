<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;

    protected $table = 'ambiente';

    protected $fillable = [
        'nombre_ambiente',
        'capacidad',
        'habilitada',
        'ubicacion_id'
    ];

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class);
    }
}
