<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilidad extends Model
{
    protected $table = 'facilidad';
    protected $primaryKey = 'id_facilidad';

    // Relación de muchos a uno: Una facilidad pertenece a un aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
    use HasFactory;
}
