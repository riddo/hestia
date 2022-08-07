@extends('admin.layout')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{$cantidadEmpleados}}</h3>

                        <p>Total de empleados</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ url('admin/empleados') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$activos}}</h3>

                        <p>Empleados activos ahora</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="{{ url('admin/empleados') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$inactivos}}</h3>

                        <p>Empleados inactivos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pause"></i>
                    </div>
                    <a href="{{ url('admin/empleados') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">

            @if($empleados)
            @foreach ($empleados as $empleado)
            <div class="col-md-3">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <div class="widget-user-image">
                            @switch($empleado->empleado_genero)
                                @case("Masculino")
                                    <img class="img-circle elevation-2" src="{{ asset('public/img/man.png') }}" alt="User Avatar">
                                    @break
                                @case("Femenino")
                                    <img class="img-circle elevation-2" src="{{ asset('public/img/woman.png') }}" alt="User Avatar">
                                    @break
                                @default
                                    <img class="img-circle elevation-2" src="{{ asset('public/img/user.png') }}" alt="User Avatar">
                            @endswitch($empleado->empleado_genero)

                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{$empleado->empleado_nombre." ".$empleado->empleado_apellido}}</h3>
                        <h5 class="widget-user-desc">{{$empleado->cargos->cargo_nombre}}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Estado <span class="float-right badge {{$empleado->estado_turno ? "bg-success":"bg-warning"}}">{{$empleado->estado_turno ? "TRABAJANDO":"INACTIVO"}}</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            @endforeach

            @endif
        </div>


        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
