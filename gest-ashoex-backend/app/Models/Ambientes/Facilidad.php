<?php

namespace App\Models\Ambientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilidad extends Model
{
    use HasFactory;
    protected $table = 'facilidad';
    protected $primaryKey = 'id_facilidad';
    protected $fillable = ['nombre_facilidad', 'id_aula'];
    protected $hidden = ['created_at', 'updated_at'];

    public function aula()
    {
        return $this->belongsTo(Aula::class, 'id_aula');
    }
}
