<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    protected $table = 'uso';
    protected $primaryKey = 'id_uso';

    // Relación de muchos a uno: Un uso pertenece a un aula
    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
    use HasFactory;
}
