@extends('admin.layout')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Asistencias </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Asistencias</li>
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
                            data-target="#nuevoAsistencia">
                            <i class="fas fa-plus-circle"></i>&nbsp; Nueva Asistencia
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaAsistencias" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Empleado</th>
                                    <th>Registro de asistencia</th>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($asistencias)
                                    @foreach ($asistencias as $asistencia)
                                        <tr>
                                            <td>{{ $asistencia->id }}</td>
                                            <td><a
                                                    href="empleados/{{ $asistencia->empleados->id }}/turnos">{{ $asistencia->empleados->empleado_nombre . ' ' . $asistencia->empleados->empleado_apellido . ' : ' . $asistencia->empleados->cargos->cargo_nombre }}</a>
                                            </td>
                                            <td>{{ date('d/m/Y H:i', strtotime($asistencia->registro_fecha)) }}</td>
                                            <td>{{ ucfirst($asistencia->registro_tipo) }}</td>

                                            <td>
                                                {{-- <button type="button" class="btn btn-app bg-gradient-info"
                                                    data-toggle="modal" data-target="#verCargo"
                                                    data-id="{{ $asistencia->id }}">
                                                    <i class="fas fa-eye"></i>
                                                    Ver
                                                </button> --}}
                                                <button type="button"
                                                    class="btn btn-app bg-gradient-success editarAsistencia"
                                                    data-toggle="modal" data-target="#editarAsistenciaModal"
                                                    value="{{ $asistencia->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif




                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre Empleado</th>
                                    <th>Registro de asistencia</th>
                                    <th>Tipo</th>
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
    @include('admin.asistencias.modal')




    <script>
        $(function() {
            $("#tablaAsistencias").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "responsive": true,


            }).buttons().container().appendTo('#tablaAsistencias_wrapper .col-md-6:eq(0)');

        });


    </script>
@endsection
