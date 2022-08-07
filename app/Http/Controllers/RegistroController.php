<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;



class RegistroController extends Controller
{
    //
    public function index(){
        $idEmpleado = 2;
        $asistencias = Asistencia::where('asistencia_idEmpleado', '=', $idEmpleado)->get();
        //Acá guardo el resultado de la diferencia de minutos
        $minutos = [];

        // for($i = 0; $i < sizeof($asistencias); $i++){
        //     $fecha1 = Carbon::create($asistencias[$i]['registro_fecha']);
        //     $z = $i+1;
        //     $fecha2 = Carbon::create($asistencias[$z]['registro_fecha']);
        //     $min = $fecha1->diffInMinutes($fecha2);
        //     $i = $z;
        //     array_push($minutos, $min);
        // }
        // printf(Carbon::now());
        // $fecha1 = Carbon::create($asistencias[0]['registro_fecha']);
        // $fecha2 = Carbon::create($asistencias[1]['registro_fecha']);
        // echo "</br>";
        // echo $fecha1."    ".$fecha2;
        // echo "</br>";
        // echo "Diferencia: ".$fecha1->diffInMinutes($fecha2);
        //echo Carbon::diffInMinutes()
        // foreach($minutos as $minuto){
        //     echo $minuto." minutos";
        //     echo "<br>";
        // }

        // foreach($asistencia as $asistencia){

        // }

        $empleados = Empleado::all();
        return view('admin.registros.index', ["empleados" => $empleados]);
    }

    public function consultar(Request $request){

        /*** BUSCAR EMPLEADO POR LA ID ***/

        $idEmpleado = $request->idEmpleado;
        $empleado = Empleado::find($idEmpleado);

        /** FORMATEAR FECHAS ***/

        $fechas = $request->fechaRegistro;
        $fechas = explode("-", $fechas);

        $fecha_1Format = str_replace("/", "-", $fechas[0]);
        $fecha_2Format = str_replace("/", "-", trim($fechas[1]));

        $fechaInicio = date("Y-m-d", strtotime($fecha_1Format));
        $fechaFin = date("Y-m-d 23:59:59" , strtotime($fecha_2Format));

        /*** TRAER ASISTENCIAS SEGÚN RANGO DE FECHAS E ID DE EMPLEADO ***/

        $asistencias = Asistencia::whereBetween('registro_fecha', [$fechaInicio, $fechaFin])
                                            ->where('asistencia_idEmpleado', "=", $empleado->id)
                                            ->get();

        $cant_asistencias = sizeof($asistencias);

        if ( $cant_asistencias!==0 ){
            $ultimoIndice = $cant_asistencias - 1;
            $ultimoRegistro = $asistencias[$ultimoIndice];

            $tipoRegistro = $ultimoRegistro->registro_tipo;

            $informe = array();

            $minutos = 0;
            $horas = 0;
            $resultado = "";

            if ( $tipoRegistro === "salida"){

                for ($i = 0, $j = 0; $i < $cant_asistencias; $i++, $j++){

                    $fechaInicio = Carbon::create($asistencias[$i]['registro_fecha']);
                    $fIni_format = date("m-d-Y H:i", strtotime($fechaInicio));

                    $z = $i+1;

                    $fechaFin = Carbon::create($asistencias[$z]['registro_fecha']);
                    $fFin_format = date("m-d-Y H:i", strtotime($fechaFin));

                    $difTiempo = $fechaInicio->diffInMinutes($fechaFin);

                    if($difTiempo < 60){
                        $resultado = $difTiempo. " minutos";
                    }
                    else if($difTiempo > 60){
                        $horas = intdiv($difTiempo,60);
                        $minutos = $difTiempo % 60;
                        $resultado = $horas." horas, ".$minutos." minutos";
                    }
                    $informe[$j]["fechaIngreso"] = $fIni_format;
                    $informe[$j]["fechaSalida"] = $fFin_format;
                    $informe[$j]["tiempo"] = $resultado;

                    $i = $z;

                }
                return view("admin.registros.informe", ["informe" => $informe, "empleado" => $empleado]);
            }else{
                echo "<script>";
                echo "alert('Registre la salida primero');";
                echo "window.location = '/Proyectos/hestia/admin/registros'";
                echo "</script>";
            }
        } else{
            echo "<script>";
                echo "alert('No hay registros en estas fechas');";
                echo "window.location = '/Proyectos/hestia/admin/registros'";
                echo "</script>";
        }






    }


    public function generarPDF(){

    // instantiate and use the dompdf class

    $pdf = PDF::loadView('admin.registros');

    // (Optional) Setup the paper size and orientation




    // Output the generated PDF to Browser
    return $pdf->stream();

    }


}
       //Crear arreglo de empleado
        //Crear arreglo de turnos


        // $fecha1 = $request->fechaInicio;
        // $fecha2 = $request->fechaFin;

        // $fecha1Format = date("Y-m-d", strtotime($fecha1));
        // $fecha2Format = date("Y-m-d", strtotime($fecha2));



        // $asistencias = Asistencia::where('asistencia_idEmpleado', '=', $empleado->id)->get();

        // $asistenciasRangoFecha = Asistencia::whereBetween('registro_fecha', [$fecha1Format, $fecha2Format])
        //             ->where('asistencia_idEmpleado', "=", $empleado->id)
        //                 ->get();


        // if(sizeof($asistenciasRangoFecha)!==0){
        //     $lastDataByDateIndex =  sizeof($asistenciasRangoFecha)-1;
        //     $lastData = $asistenciasRangoFecha[$lastDataByDateIndex];

        //     $tipoRegistro = $lastData->registro_tipo;
        //     $registro = array();

        //     //consultar de que el ultimo registro de asistencia sea salida.



        //     if($tipoRegistro === "salida"){
        //         for($i = 0; $i < sizeof($asistencias); $i++){

        //             $fecha1 = Carbon::create($asistencias[$i]['registro_fecha']);
        //             $fechaFormat = date("m-d-Y H:i", strtotime($fecha1));
        //             $z = $i+1;
        //             $fecha2 = Carbon::create($asistencias[$z]['registro_fecha']);
        //             $fechaFormat2 = date("m-d-Y H:i", strtotime($fecha2));
        //             $min = $fecha1->diffInMinutes($fecha2);

        //                 //$resultado = intdiv($min,60);
        //                 $horas = $min." minutos";


        //             $i = $z;
        //             $registro[$i]["fechaIngreso"] = $fechaFormat;
        //             $registro[$i]["fechaSalida"] = $fechaFormat2;
        //             $registro[$i]["tiempo"] = $horas;
        //             //array_push($minutos, $min);
        //         }


        //         return view("admin.registros.informe", ["registro" => $registro]);

        //     }else{
        //         return response()->json([
        //             'status' => 401,
        //         ]);
        //     }
        // }else{
        //     return response()->json([
        //         'status' => 402,
        //     ]);
        // }

