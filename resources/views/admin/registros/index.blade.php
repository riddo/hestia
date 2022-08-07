@extends('admin.layout')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Generador de informes mensuales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Reportes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="row">

            <div class="col-12">
                <div class="card p-4">
                    <form id="consultarInforme" method="POST" action="{{ url('admin/registros/consultar') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="idEmpleado">Seleccionar empleado</label>
                            <select class="selectorEmpleados form-control" name="idEmpleado" id="idEmpleado" required>
                                <option value="" selected disabled>---Seleccionar---</option>
                                @if ($empleados)
                                    @foreach ($empleados as $empleado)
                                    <option value="{{$empleado->id}}">{{ $empleado->empleado_nombre." ".$empleado->empleado_apellido." RUN: ".$empleado->empleado_rut." cargo: ".$empleado->cargos->cargo_nombre}}</option>

                                    @endforeach
                                @endif

                            </select>
                        </div>



                        <div class="form-group">
                            <label for="fechaRegistro">Seleccionar fecha:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                <input type="text" name="fechaRegistro" class="form-control float-right" id="fechaRegistro">
                            </div>
                            <!-- /.input group -->
                            </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btnBuscar">Buscar</button>
                        </div>
                    </form>
                </div>


            </div>



    </div>
</div>


@endsection

@section('scripts')
@endsection


