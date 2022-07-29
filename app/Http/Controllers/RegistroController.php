<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;



class RegistroController extends Controller
{
    //
    public function index(){
        $idEmpleado = 2;
        $asistencias = Asistencia::where('asistencia_idEmpleado', '=', $idEmpleado)->get();
        //Acá guardo el resultado de la diferencia de minutos
        $minutos = [];

        for($i = 0; $i < sizeof($asistencias); $i++){
            $fecha1 = Carbon::create($asistencias[$i]['registro_fecha']);
            $z = $i+1;
            $fecha2 = Carbon::create($asistencias[$z]['registro_fecha']);
            $min = $fecha1->diffInMinutes($fecha2);
            $i = $z;
            array_push($minutos, $min);
        }
        // printf(Carbon::now());
        // $fecha1 = Carbon::create($asistencias[0]['registro_fecha']);
        // $fecha2 = Carbon::create($asistencias[1]['registro_fecha']);
        // echo "</br>";
        // echo $fecha1."    ".$fecha2;
        // echo "</br>";
        // echo "Diferencia: ".$fecha1->diffInMinutes($fecha2);
        //echo Carbon::diffInMinutes()
        foreach($minutos as $minuto){
            echo $minuto." minutos";
            echo "<br>";
        }

        foreach($asistencia as $asistencia){

        }
        //return view('admin.registros.index', ["asistencias" => $asistencias]);
    }

}
