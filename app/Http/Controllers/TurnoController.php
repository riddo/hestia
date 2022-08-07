<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Support\Facades\Validator;
class TurnoController extends Controller
{
    public function index($idEmpleado)
    {
        //Llamar a los empleados
        $horarios = Horario::all();
        $turnos = Turno::all();
        $empleado = Empleado::find($idEmpleado);



        return view('admin.turnos.index', ["empleado"=>$empleado, "horarios" => $horarios, "turnos" => $turnos]);
        //LLamar a los horarios
    }

    public function store($idEmpleado, Request $request)
    {
        /** Validación: Se debe seleccionar al menos un horario **/
        $validator = Validator::make($request->all(), [
            'idHorario' => 'required',
        ],
        [
            'idHorario.required' => 'Selecciona el turno'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        /** Validar si existe ya el turno asignado **/

        /** Guardar turno en la base de datos **/
        $idHorario = $request->idHorario;
        $turno = Turno::where(['horario_id' => $idHorario, 'empleado_id' => $idEmpleado])->first();
        if($turno==null){
            $turnoNuevo = new Turno;
            $turnoNuevo->empleado_id = $idEmpleado;
            $turnoNuevo->horario_id = $idHorario;
            $turnoNuevo->save();
            return response()->json([
                'status' => 200,
            ]);
        }else{
            return response()->json([
                'resp' => 'registro_existente'

            ]);
        }
    }


    public function destroy($idEmpleado, $idTurno)
    {

        $turno = Turno::where('horario_id', "=", $idTurno)->first();
        $turno->delete();
        return response()->json([
            'status' => 200,
        ]);
    }
}
