@extends('admin.layout')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de cargos de la empresa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Cargos</li>
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
                            data-target="#nuevoCargo">
                            <i class="fas fa-plus-circle"></i>&nbsp; Nuevo Cargo
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tablaCargos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Fecha creación</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($cargos)
                                    @foreach ($cargos as $cargo)
                                        <tr>
                                            <td>{{ $cargo->id }}</td>
                                            <td>{{ $cargo->cargo_nombre }}</td>
                                            <td>{{ $cargo->created_at }}</td>

                                            <td>
                                                {{-- <button type="button" class="btn btn-app bg-gradient-info"
                                                    data-toggle="modal" data-target="#verCargo"
                                                    data-id="{{ $cargo->id }}">
                                                    <i class="fas fa-eye"></i>
                                                    Ver
                                                </button> --}}
                                                <button type="button" class="btn btn-app bg-gradient-success editarCargo"
                                                    data-toggle="modal" data-target="#editarCargoModal"
                                                    value="{{ $cargo->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </button>

                                                <button type="button" class="btn btn-app bg-gradient-danger eliminarCargo"
                                                value="{{$cargo->id}}">
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
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Fecha creación</th>
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
    @include('admin.cargos.modal')



    <script>
        $(function() {
            $("#tablaCargos").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "responsive": true,


            }).buttons().container().appendTo('#tablaCargos_wrapper .col-md-6:eq(0)');

        });


    </script>
@endsection
