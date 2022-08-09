<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Support\Facades\Validator;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        $empleados = Empleado::all();
        return view('admin.empleados.index', ["cargos" => $cargos, "empleados" => $empleados]);
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
        $validator = Validator::make($request->all(), [
            'nombreEmpleado' => 'required',
            'apellidoEmpleado' => 'required',
            'rutEmpleado' => 'required',
            'cargoEmpleado' => 'required',
            'generoEmpleado' => 'required'
        ],
        [
            'nombreEmpleado.required' => 'Campo nombre obligatorio',
            'apellidoEmpleado.required' => 'Campo apellido obligatorio',
            'rutEmpleado.required' => 'Campo RUT obligatorio',
            'cargoEmpleado.required' => 'Selecciona cargo empleado',
            'generoEmpleado.required' => "Selecciona género"
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        /****GENERAR CODIGO QR a traves de un codigo */
        $nAleatorio = rand(1, 5000);
        $codigo_qr = $request->nombreEmpleado."".$request->apellidoEmpleado."".$nAleatorio;

        $empleado = new Empleado;
        $empleado->empleado_nombre = ucfirst($request->nombreEmpleado);
        $empleado->empleado_apellido = ucfirst($request->apellidoEmpleado);
        $empleado->empleado_rut = $request->rutEmpleado;
        $empleado->empleado_fono = $request->fonoEmpleado;
        $empleado->empleado_direccion = $request->direccionEmpleado;
        $empleado->empleado_correo = $request->emailEmpleado;
        $empleado->empleado_genero = $request->generoEmpleado;
        $empleado->codigo = $codigo_qr;
        $empleado->empleado_idCargo = $request->cargoEmpleado;
        $empleado->save();

        return response()->json([
            'status' => 200
        ]);

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
        $empleado = Empleado::find($id);

        if($empleado){
            return response()->json([
                'status' => 200,
                'empleado' => $empleado

            ]);
        }else{
            return response()->json([
                'status' => 400
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
            'editarNombreEmpleado' => 'required',
            'editarApellidoEmpleado' => 'required',
            'editarRutEmpleado' => 'required',
            'editarCargoEmpleado' => 'required',
            'editarGeneroEmpleado' => 'required'
        ],
        [
            'editarNombreEmpleado.required' => 'Campo nombre obligatorio',
            'editarApellidoEmpleado.required' => 'Campo apellido obligatorio',
            'editarRutEmpleado.required' => 'Campo RUT obligatorio',
            'editarCargoEmpleado.required' => 'Selecciona cargo empleado',
            'editarGeneroEmpleado.required' => "Selecciona género"
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        $empleado = Empleado::find($id);
        if($empleado){
            $empleado->empleado_nombre = ucfirst($request->editarNombreEmpleado);
            $empleado->empleado_apellido = ucfirst($request->editarApellidoEmpleado);
            $empleado->empleado_rut = $request->editarRutEmpleado;
            $empleado->empleado_fono = $request->editarFonoEmpleado;
            $empleado->empleado_direccion = $request->editarDireccionEmpleado;
            $empleado->empleado_correo = $request->editarEmailEmpleado;
            $empleado->empleado_genero = $request->editarGeneroEmpleado;
            $empleado->empleado_idCargo = $request->editarCargoEmpleado;
            $empleado->update();
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
        $empleado = Empleado::find($id);
        $empleado->delete();
        return response()->json([
            'status' => 200,
        ]);
    }


    public function updateQr($QrCode){

        $empleado = Empleado::where('codigo', '=', $QrCode)->first();
        if(!$empleado == null){
            $nAleatorio = rand(1, 5000);
            $newQrCode = $empleado->empleado_nombre."".$empleado->empleado_apellido."".$nAleatorio;
            if($newQrCode!==$QrCode){
                $empleado->codigo = $newQrCode;
                $empleado->update();
                return response()->json([
                    'resp' => 'exito',
                    'QrCode' => $empleado->codigo,
                    'status' => 200
                ]);
            }
            }


    }

}
