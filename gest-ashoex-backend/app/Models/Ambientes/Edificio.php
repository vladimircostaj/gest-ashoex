<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;
    protected $table = 'edificio';
    protected $primaryKey = 'id_edificio';
    protected $fillable = ['nombre_edificio','pisos' ,'geolocalizacion'];
    protected $hidden = ['created_at', 'updated_at'];
    

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'id_edificio');
    }
}
