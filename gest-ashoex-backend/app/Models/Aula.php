<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $table = 'aula';
    protected $primaryKey = 'id_aula';
    protected $fillable = ['numero_aula', 'capacidad', 'habilitada', 'id_ubicacion', 'id_uso'];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function uso()
    {
        return $this->belongsTo(Uso::class, 'id_uso');
    }

    public function facilidades()
    {
        return $this->belongsToMany(Facilidad::class, 'aula_facilidad', 'id_aula', 'id_facilidad');
    }
}
