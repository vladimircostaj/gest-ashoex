<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAcademico extends Model
{
    use HasFactory;

    protected $table = 'personal_academicos';

    protected $fillable = [
        'name',
        'email',
        'telefono',
        'estado',
        'tipo_personal_id',
    ];

    public function tipoPersonal()
    {
        return $this->belongsTo(TipoPersonal::class, 'tipo_personal_id');
    }
}
