<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $table = 'aula';
    protected $primaryKey = 'id_aula';
    protected $fillable = ['numero_aula', 'capacidad', 'habilitada', 'id_ubicacion'];
    protected $hidden = ['created_at', 'updated_at'];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function usos()
    {
        return $this->hasMany(Uso::class, 'id_aula');
    }

    public function facilidades()
    {
        return $this->hasMany(Facilidad::class, 'id_aula');
    }
}
