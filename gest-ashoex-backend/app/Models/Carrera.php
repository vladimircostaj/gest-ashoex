<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'Carrera';
    protected $primaryKey = 'carrera_id';
    protected $fillable = ['nombre', 'nro_semestres'];

    public function curriculas()
    {
        return $this->hasMany(Curricula::class);
    }
    use HasFactory;
}
