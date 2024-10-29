<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';
    protected $fillable = ['piso', 'id_edificio'];
    protected $hidden = ['created_at', 'updated_at'];

    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'id_edificio');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'id_ubicacion');
    }
}
