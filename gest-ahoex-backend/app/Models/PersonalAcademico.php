<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;
use App\Models\Auxiliar;

class PersonalAcademico extends Model
{
    protected $table = 'personal_academicos';
    protected $primaryKey = 'personal_academico_id';
    protected $fillable = ['nombre', 'email', 'telefono'];

    function tipoPersonal()
    {
        return $this->belongsTo(TipoPersonal::class);
    }

    use HasFactory;
}
