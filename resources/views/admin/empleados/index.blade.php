@extends('admin.layout')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Empleados</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Empleados</li>
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
                            data-target="#nuevoEmpleado">
                            <i class="fas fa-plus-circle"></i>&nbsp; Nuevo Empleado
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaEmpleados" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>RUN</th>
                                    <th>Cargo</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Fono</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                 @if ($empleados)
                                    @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{ $empleado->empleado_nombre ." ".$empleado->empleado_apellido }}</td>
                                            <td>{{ $empleado->empleado_rut}}</td>
                                            <td>{{ $empleado->cargos->cargo_nombre}}</td>
                                            <td>{{ $empleado->empleado_direccion == null ? 'Sin dirección' :  $empleado->empleado_direccion}}</td>
                                            <td>{{ $empleado->empleado_correo == null ? 'Sin correo' : $empleado->empleado_correo }}</td>
                                            <td>{{ $empleado->empleado_fono == null ? 'Sin Fono' : $empleado->empleado_fono}}</td>

                                            <td>
                                                 <a type="button" class="btn btn-app bg-gradient-info"
                                                    href="{{url('admin/empleados/'.$empleado->id).'/turnos'}}">
                                                    <i class="fas fa-calendar-check"></i>
                                                    Turnos
                                                </a>
                                                <button type="button" class="btn btn-app bg-gradient-success editarEmpleadoBtn"
                                                    data-toggle="modal" data-target="#editarEmpleadoModal"
                                                    value="{{ $empleado->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </button>

                                                <button type="button" class="btn btn-app bg-gradient-danger eliminarEmpleadoBtn"
                                                value="{{$empleado->id}}">
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
                                    <th>Nombre Completo</th>
                                    <th>RUN</th>
                                    <th>Cargo</th>
                                    <th>Dirección</th>
                                    <th>Correo</th>
                                    <th>Fono</th>
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
    @include('admin.empleados.modal')



    <script>
        $(function() {
            $("#tablaEmpleados").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "responsive": true,


            }).buttons().container().appendTo('#tablaEmpleados_wrapper .col-md-6:eq(0)');

        });


    </script>
@endsection
