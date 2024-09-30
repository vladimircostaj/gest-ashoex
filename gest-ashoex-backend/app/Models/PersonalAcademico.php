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

    public function darBaja(): bool 
    {
        if ($this->estaDadoDeBaja()) {
            return false; 
        } else {
            $this->estado = config('constants.PERSONAL_ACADEMICO_ESTADOS')[1];
            $this->save();
            return true;
        }
    }

    private function estaDadoDeBaja(): bool 
    {
        return $this->estado == config('constants.PERSONAL_ACADEMICO_ESTADOS')[1];
    }
}
