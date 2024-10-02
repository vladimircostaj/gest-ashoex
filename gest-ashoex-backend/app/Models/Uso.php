<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    use HasFactory;
    protected $table = 'uso';
    protected $primaryKey = 'id_uso';
    protected $fillable = ['tipo_uso', 'id_aula'];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
}
