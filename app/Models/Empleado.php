<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function cargos(){
        return $this->belongsTo(Cargo::class, 'empleado_idCargo');
    }

    public function asistencias(){
        return $this->belongsTo(Asistencia::class, 'asistencia_idEmpleado');
    }

    public function horarios(){
        return $this->belongsToMany(Horario::class, 'turnos');
    }


}
