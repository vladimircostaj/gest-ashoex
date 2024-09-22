<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'curricula_id'];

    public function curricula()
    {
        return $this->belongsTo(Curricula::class);
    }
    use HasFactory;
}
