<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{

    use HasFactory;
    public $timestamps = false;



    public function empleados(){
        return $this->belongsTo(Empleado::class, 'asistencia_idEmpleado');
    }
}
