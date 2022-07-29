<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{

    use HasFactory;
    public $timestamps = false;

    public function horarios(){
        return $this->hasMany(Horario::class, 'id');
    }

    public function empleados(){
        return $this->hasMany(Empleado::class, 'id');
    }
}
