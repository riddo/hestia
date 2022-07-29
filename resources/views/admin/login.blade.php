<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hestia Fpyme Admin Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Hestia</b>dmin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Ingresa para iniciar sesión</p>

                <form action="{{ url('admin/login') }}" method="post">
                    @csrf


                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="password"
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" value="login" class="btn btn-primary btn-block">Ingresar</button>
                        </div>

                        <!-- /.col -->
                    </div>
                </form>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach
                @endif
                @if (Session::has('msg'))
                    <p class="text-danger">
                        <strong>{{ session('msg') }}</strong>
                    </p>
                @endif
                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="https://fpymeatacama.cl" target="_blank">
                        <img src="{{ asset('public') }}/fpyme-logo.png" alt="logo fypme" width="270">
                    </a>
                </div>
                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('public/lteadmin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/lteadmin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/lteadmin') }}/dist/js/adminlte.min.js"></script>
</body>

</html>
