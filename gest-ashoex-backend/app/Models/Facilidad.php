<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilidad extends Model
{
    use HasFactory;
    protected $table = 'facilidad';
    protected $primaryKey = 'id_facilidad';
    protected $fillable = ['nombre_facilidad', 'id_aula'];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
}
