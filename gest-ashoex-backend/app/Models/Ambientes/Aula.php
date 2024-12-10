<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;
    protected $table = 'aula';
    protected $primaryKey = 'id_aula';
    protected $fillable = ['numero_aula', 'capacidad', 'habilitada','id_edificio','ubicacion'];
    protected $hidden = ['created_at', 'updated_at'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edificio');
    }

    public function usos()
    {
        return $this->belongsToMany(Uso::class, 'aula_uso', 'id_aula','id_uso');
    }

    public function facilidades()
    {
        return $this->belongsToMany(Facilidad::class, 'aula_facilidad', 'id_aula', 'id_facilidad');
    }
}
