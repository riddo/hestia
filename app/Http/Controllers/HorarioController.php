<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use Illuminate\Support\Facades\Validator;


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Horario::all();
        return view('admin.horarios.index', ['horarios' => $horarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Validation

        $validator = Validator::make($request->all(), [
                'turno' => 'required',
                'dias' => 'required',
                'horaIngreso' => 'required',
                'horaSalida' => 'required'
            ],
            [
                'horaIngreso.required' => 'La hora de ingreso es obligatoria',
                'horaSalida.required' => 'La hora de salida es obligatoria',
                'turno.required' => 'El nombre del turno es obligatorio',
                'dias' => 'Los días son obligatorios'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        $diasToString = implode(',', $request->dias);
        //Forma convencional de guardar un item

        $turno = ucfirst($request->turno);
        $tipoTurno = Horario::where('nombre_turno', '=', $turno)->first();
        if($tipoTurno == null){
            $horario = new Horario;
            $horario->nombre_turno = $turno;
            $horario->dias = $diasToString;
            $horario->hora_ingreso = $request->horaIngreso;
            $horario->hora_salida = $request->horaSalida;
            $horario->save();
            return response()->json([
                'resp' => 'exito',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'resp' => 'existe',

            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::find($id);
        if($horario){
            return response()->json([
                'status' => 200,
                "horario" => $horario
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => "Horario no encontrado"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'editarTurno' => 'required',
                'editarDias' => 'required',
                'editarHoraIngreso' => 'required',
                'editarHoraSalida' => 'required'
            ],
            [
                'editarHoraIngreso.required' => 'La hora de ingreso es obligatoria',
                'editarHoraSalida.required' => 'La hora de salida es obligatoria',
                'editarTurno.required' => 'El nombre del turno es obligatorio',
                'editarDias' => 'Los días son obligatorios'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $horario = Horario::find($id);
        $turno = ucfirst($request->editarTurno);
        $diasToString = implode(',', $request->editarDias);
        if($horario){
            $horario->nombre_turno = $turno;
            $horario->dias = $diasToString;
            $horario->hora_ingreso = $request->editarHoraIngreso;
            $horario->hora_salida = $request->editarHoraSalida;
            $horario->update();
            return response()->json([
                'resp' => 'exito',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'errors' => "Horario no encontrado"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario = Horario::find($id);
        $horario->delete();
        return response()->json([
            'status' => 200,
        ]);
    }
}
