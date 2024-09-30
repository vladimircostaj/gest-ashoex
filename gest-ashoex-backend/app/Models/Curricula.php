<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curricula extends Model
{
    protected $table = 'Curricula';
    protected $fillable = ['carrera_id', 'materia_id'];

    use HasFactory;
}
