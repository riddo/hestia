@extends('admin.layout')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Configuración General</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Configuración</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="content">
    <div class="row">

            <div class="col-12">
                <div class="card p-4">
                    <form  method="POST" action="{{ url('admin/config/update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" value="{{$admin->username}}">
                        </div>
                        <div class="form-group">
                            <label for="fullname">Nombre Completo</label>
                            <input type="text" class="form-control" name="fullname" value="{{$admin->nombreCompleto}}">
                        </div>
                        <div class="form-group">
                            <label for="empresa">Nombre de la empresa</label>
                            <input type="text" class="form-control" name="empresa" value="{{$admin->empresa}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$admin->correo}}">
                        </div>

                        @if (Session::has('msg'))
                        <p class="text-success">
                            <strong>{{ session('msg') }}</strong>
                        </p>
                         @endif

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>


            </div>



    </div>
</div>

@endsection
