<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    use HasFactory;
    protected $table = 'uso';
    protected $primaryKey = 'id_uso';
    protected $fillable = ['tipo_uso'];
    protected $hidden = ['created_at', 'updated_at'];

    public function aulas()
    {
        return $this->belongsToMany(Aula::class, 'aula_uso', 'id_uso', 'id_aula');
    }
}
