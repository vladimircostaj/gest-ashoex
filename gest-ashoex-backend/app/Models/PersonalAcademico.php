<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAcademico extends Model
{
    protected $table = 'personal_academicos';
    protected $fillable = ['nombre', 'email', 'telefono'];

    function tipoPersonal()
    {
        return $this->belongsTo(TipoPersonal::class);
    }
    use HasFactory;
}
