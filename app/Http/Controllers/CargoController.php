<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\Validator;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::all();
        return view('admin.cargos.index', ['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
                'nombreCargo' => 'required|max:70'
            ],
            [
                'nombreCargo.required' => 'El campo cargo es requerido'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        //Forma convencional de guardar un item
        $nombreCargo = ucfirst($request->nombreCargo);

        $cargo = Cargo::where('cargo_nombre', '=', $nombreCargo)->first();
        if($cargo == null){
            $nuevoCargo = new Cargo();
            $nuevoCargo->cargo_nombre = $nombreCargo;
            $nuevoCargo->save();
            return response()->json([
                'resp' => 'exito',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'resp' => 'registro_existente'

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
        $cargo = Cargo::find($id);

        if($cargo){
            return response()->json([
                'status' => 200,
                "cargo" => $cargo
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => "Cargo no encontrado"
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
        //Validation

        $validator = Validator::make($request->all(), [
                'editarNombreCargo' => 'required|max:70'
            ],
            [
                'editarNombreCargo.required' => 'El campo cargo es requerido'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        //Forma convencional de guardar un item

        $cargoNombreActual = ucfirst($request->editarNombreCargo);

        $cargoEncontrado = Cargo::where('cargo_nombre', '=', $cargoNombreActual)->first();

        if($cargoEncontrado == null){
            $cargo = Cargo::find($id);
            $cargoEditado = ucfirst($request->editarNombreCargo);
            $cargo->cargo_nombre = $cargoEditado;
            $cargo->update();
            return response()->json([
                'resp' => 'exito',
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'errors' => "El cargo ya existe"
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
        $cargo = Cargo::find($id);
        $cargo->delete();
        return response()->json([
            'status' => 200,
        ]);
    }
}
