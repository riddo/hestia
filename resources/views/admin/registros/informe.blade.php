@extends('admin.layout')
@section('content')



<div class="content pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <a style="display: block" href="javascript:window.print()" id="print" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Imprimir
                    </a>
                    <div class="col-sm-6">
                        @if($empleado)
                            <p><span class="text-uppercase font-weight-bold">Nombre Completo: </span> {{$empleado->empleado_nombre." ".$empleado->empleado_apellido}}</p>
                            <p><span class="text-uppercase font-weight-bold">RUN: </span> {{$empleado->empleado_rut}}</p>
                            <p><span class="text-uppercase font-weight-bold">Dirección: </span> {{$empleado->empleado_direccion}}</p>
                            <p><span class="text-uppercase font-weight-bold">Fono: </span> {{$empleado->empleado_fono}}</p>
                            <p><span class="text-uppercase font-weight-bold">Cargo: </span> {{$empleado->cargos->cargo_nombre}}</p>

                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title ">Registro de Asistencia</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          <table class="table table-sm">
                            <thead>
                              <tr>

                                <th>Fecha y hora de entrada</th>
                                <th>Fecha y hora de salida</th>
                                <th>Tiempo</th>

                              </tr>
                            </thead>
                            <tbody>
                                @if($informe)
                                @for ($i = 0; $i < sizeof($informe); $i++)
                                    <tr>
                                        <td>{{$informe[$i]["fechaIngreso"]}}</td>
                                        <td>{{$informe[$i]["fechaSalida"]}}</td>
                                        <td>{{$informe[$i]["tiempo"]}}</td>
                                    </tr>
                                @endfor
                                @endif
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>




@endsection

@section('scripts')
@endsection

