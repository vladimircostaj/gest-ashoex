<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilidad extends Model
{
    use HasFactory;
    protected $table = 'facilidad';
    protected $primaryKey = 'id_facilidad';
    protected $fillable = ['nombre_facilidad'];

    public function aulas()
    {
        return $this->belongsToMany(Aula::class, 'aula_facilidad', 'id_facilidad', 'id_aula');
    }
}
