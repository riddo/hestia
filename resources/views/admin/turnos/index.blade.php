@extends('admin.layout')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Turnos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{url('admin/empleados')}}">Empleados</a></li>
                    <li class="breadcrumb-item active">Turnos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <h3>{{$empleado->empleado_nombre.' '.$empleado->empleado_apellido}}</h3>
                            <p>{{$empleado->cargos->cargo_nombre}}</p>
                        </div>

                        <!-- /.info-box-content -->
                    </div>

                    <form id="turnoForm">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" name="idEmpleado" id="idEmpleado" value="{{$empleado->id}}">
                            <div class="form-group">
                                <label>Asignar turno a empleado</label>
                                <p class="text-danger errores"></p>
                                <select class="form-control"   style="width: 100%;" name="idHorario" id="idHorario">
                                    <option selected disabled>--Selecciona turno--</option>
                                    @if($horarios)
                                    @foreach ($horarios as $horario)
                                        <option value="{{$horario->id}}">{{$horario->nombre_turno.': '.$horario->dias.' de '.$horario->hora_ingreso.' a '.$horario->hora_salida}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Guardar</button>
                        </div>


                    </form>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablaTurnos" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>Turno</th>
                                <th>Horario</th>
                                <th>Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($turnos)
                            @foreach ($empleado->horarios as $turno)
                                <tr>

                                    <td>{{ $turno->nombre_turno.' --- '.$turno->dias}}</td>
                                    <td>{{ 'De '.$turno->hora_ingreso.' a '.$turno->hora_salida}}</td>

                                    <td>


                                        <button type="button" class="btn btn-app bg-gradient-danger eliminarTurno"
                                            value="{{ $turno->id }}">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif




                        </tbody>
                        <tfoot>
                            <tr>

                                <th>Turno</th>
                                <th>Horario</th>
                                <th>Acciones</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>


@endsection




@section('scripts')
@include('admin.turnos.modal')

<script>
    $(function() {
        $("#tablaTurnos").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "responsive": true,


        }).buttons().container().appendTo('#tablaTurnos_wrapper .col-md-6:eq(0)');

    });
</script>

@endsection
