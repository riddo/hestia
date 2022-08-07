<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use App\Models\Admin;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
class AsistenciaController extends Controller
{

    public function index(){
        $asistencias = Asistencia::all()->sortByDesc("id");

        $empleados = Empleado::all();
        return view('admin.asistencias.index', ['asistencias' => $asistencias, 'empleados' => $empleados]);

    }
    public function chequearAsistencia(Request $request){

        $validator = Validator::make($request->all(), [
            'codigoQr' => 'required'
        ],
        [
            'codigoQr.required' => 'El campo es requerido'
        ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
         ]);
        } else{
            //Obtengo Qr desde el formulario
            $codigoQr = $request->codigoQr;
            //Pregunto, si el codigo le pertenece al trabajador
            $empleado = Empleado::where('codigo', '=', $codigoQr)->first();
            //Si el empleado es distinto de vacío... es decir, si existe un empleado
            if($empleado !== null){
                //Guardo el nombre completo del empleado.
                $nombreEmpleado = $empleado->empleado_nombre." ".$empleado->empleado_apellido;
                //Guardo el id del empleado
                $empleadoId = $empleado->id;



                $saludo = self::ultimaAsistencia($empleadoId);

                //$nuevaAsistencia = new Asistencia();
                //$nuevaAsistencia->asistencia_idEmpleado = $empleadoId;
                //$nuevaAsistencia->registro_fecha =date('d-m-Y H:i:s');
                //$nuevaAsistencia->registro_tipo = "sin registro";
                //$nuevaAsistencia->save();
                //Modulo estado trabajador ->realizado.
                //modulo enviar correo con archivo adjunto
                //modulo listar asistencia (crud)
                //modulo listar estados de trabajadores (activar y desactivar estados)
                //Modulo reportaeria
                //modulo dashboard
                //modulo datos empresa
                //modulo configuración




                return response()->json([
                    'resp' => 'exito',
                    'status' => 200,
                    'usuario' => $saludo." ".$nombreEmpleado
                ]);
            }else{
                return response()->json([
                    'resp' => 'fracasado',
                    'usuario' => "No existe registro de esta persona"
                ]);
            }
        }

    }

    public function getEmpleadoFromAdmin(Request $request){
        $idEmpleado = $request->empleadoId;
        $empleado = Empleado::find($idEmpleado);
        $empleadoEstado = $empleado->estado_turno;

        return response()->json([
            "estado" => $empleadoEstado
        ]);
    }

    public function storeFromAdmin(Request $request){
        $validator = Validator::make($request->all(), [

            'registro' => 'required',
            'empleado' => 'required'

        ],
        [
            'registro.required' => 'Debes selecionar una opcion de registro',
            'empleado.required' => 'Selecciona un empleado'



        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        //Capturo id del empleado
        $empleadoId = $request->empleado;
        //Capturo registro de formulario
        $registro = $request->registro;

        $asistencia = new Asistencia;
        $empleado = Empleado::find($empleadoId);
        $asistencia->asistencia_idEmpleado = $empleadoId;
        if($registro === "1"){
            $asistencia->registro_tipo = "ingreso";
            $empleado->estado_turno = 1;
        }
        else if($registro === "0"){
            $asistencia->registro_tipo = "salida";
            $empleado->estado_turno = 0;
        }

        $asistencia->save();
        $empleado->update();


        return response()->json([
            'resp' => 'exito',
            'status' => 200
        ]);
    }

    static public function ultimaAsistencia($empleadoId){
        $asistencia = Asistencia::latest('registro_fecha')->where('asistencia_idEmpleado', '=', $empleadoId)->first();
        $empleado = Empleado::find($empleadoId);
        if($asistencia === null || $asistencia->registro_tipo === "salida"){
            //Insertar con ingreso
            $asistenciaNueva = new Asistencia;
            $asistenciaNueva->registro_tipo = "ingreso";
            $asistenciaNueva->asistencia_idEmpleado = $empleadoId;
            $asistenciaNueva->save();
            $saludo = "Hola";
            $empleado->estado_turno = 1;
            $empleado->update();
        }
        else if($asistencia!==null || $asistencia->registro_tipo === 'ingreso'){
            //Insertar con salida
            $asistenciaNueva = new Asistencia;
            $asistenciaNueva->registro_tipo = "salida";
            $asistenciaNueva->asistencia_idEmpleado = $empleadoId;
            $asistenciaNueva->save();
            $saludo = "Adios";
            $empleado->estado_turno = 0;
            $empleado->update();

        }

        $asistencia = Asistencia::latest('registro_fecha')->where('asistencia_idEmpleado', '=', $empleadoId)->first();



        $pdf = Pdf::loadView('pdf.asistencia-pdf', [
            'nombreCompleto' => $empleado->empleado_nombre." ".$empleado->empleado_apellido,
            'run' => $empleado->empleado_rut,
            "asistenciaTipo"=> $asistencia->registro_tipo,
            "asistenciaFecha"=> date("d-m-Y H:i", strtotime($asistencia->registro_fecha)),
            'email'=> $empleado->empleado_correo,
        ]);

        $admin = Admin::find(1);
        $correo = $admin->correo;
        Asistencia::enviarEmail($correo, $empleado, $asistencia, $pdf);
        return $saludo;
    }

    public function edit($id){
        $registroAsistencia = Asistencia::find($id);
        $fechaRegistro = $registroAsistencia->registro_fecha;

        return response()->json([
            'status' => 200,
            'fecha' => date('d/m/Y H:i', strtotime($fechaRegistro))

        ]);
    }

    public function update(Request $request, $id)
    {
        //Validation

        // $validator = Validator::make($request->all(), [
        //         'editFechaHoraRegistro' => 'required'
        //     ],
        //     [
        //         'editFechaHoraRegistro.required' => 'El campo no puede estar vacío'
        //     ]
        // );
        // if($validator->fails()){
        //     return response()->json([
        //         'status' => 400,
        //         'errors' => $validator->messages()
        //     ]);
        // }

        $fechaRegistro = Asistencia::find($id);

         $fechaSinFormato = date("Y-m-d H:i", strtotime($request->data));
         $fechaFormateada = new Datetime($fechaSinFormato);
         if($fechaRegistro != null){
             $fechaRegistro->registro_fecha = $fechaFormateada;
             $fechaRegistro->update();
             return response()->json([
                 'resp' => 'exito',
                 'status' => 200
             ]);
         }else{
             return response()->json([
                 'status' => 404,
                 'errors' => "Error"
             ]);
         }

    }


}

