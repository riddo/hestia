@extends('admin.layout')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de horarios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Horarios</li>
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

                        <button type="button" class="btn btn-outline-info btn-flat " data-toggle="modal"
                            data-target="#nuevoHorario">
                            <i class="fas fa-plus-circle"></i>&nbsp; Nuevo horario
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaHorarios" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>Turno</th>
                                    <th>Días</th>
                                    <th>Hora de ingreso</th>
                                    <th>Hora de salida</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($horarios)
                                    @foreach ($horarios as $horario)
                                        <tr>
                                            <td>{{ $horario->nombre_turno }}</td>
                                            <td>{{ $horario->dias }}</td>
                                            <td>{{ $horario->hora_ingreso }}</td>
                                            <td>{{ $horario->hora_salida }}</td>
                                            <td>

                                                <button type="button" class="btn btn-app bg-gradient-success editarHorarioBtn"
                                                    data-toggle="modal" data-target="#editarHorarioModal"
                                                    value="{{ $horario->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </button>

                                                <button type="button" class="btn btn-app bg-gradient-danger eliminarHorario"
                                                    value="{{ $horario->id }}">
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
                                    <th>Días</th>
                                    <th>Hora de ingreso</th>
                                    <th>Hora de salida</th>
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
    @include('admin.horarios.modal')



    <script>
        $(function() {
            $("#tablaHorarios").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "responsive": true,


            }).buttons().container().appendTo('#tablaHorarios_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
