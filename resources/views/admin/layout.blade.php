<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hestia Software</title>
    @if (!Session::has('adminData'))
        <script>
            window.location.href = "{{ url('admin/login') }}";
        </script>
    @else
        @php
        $empresa = session()->get('adminData')[0]['empresa'];
        $nombreCompleto = session()->get('adminData')[0]['nombreCompleto'];
        $id = session()->get('adminData')[0]['id'];
        @endphp







    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/plugins/toastr/toastr.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/plugins/daterangepicker/daterangepicker.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/lteadmin') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        Cerrar Sesión
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('admin')}}" class="brand-link">
                <img src="{{ asset('public/img/hestia.png') }}" alt="Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{$empresa}}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('public/img/admin.png') }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{$nombreCompleto}}</a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ url('admin/') }}" class="nav-link">
                                <i class="fas fa-home">&nbsp;</i>
                                <p>
                                    Inicio
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/cargos/') }}" class="nav-link">
                                <i class="fas fa-map-pin">&nbsp;</i>
                                <p>
                                    Cargos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/horarios/') }}" class="nav-link">
                                <i class="fas fa-calendar-alt">&nbsp;</i>
                                <p>
                                    Horarios
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/empleados/') }}" class="nav-link">
                                <i class="fas fa-users">&nbsp;</i>
                                <p>
                                    Empleados
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/asistencias/') }}" class="nav-link">
                                <i class="fas fa-clipboard-list">&nbsp;</i>
                                <p>
                                    Registros
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/registros/') }}" class="nav-link">
                                <i class="fas fa-book">&nbsp;</i>
                                <p>
                                   Informes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ url('admin/config')}}{{'/'.$id}}" class="nav-link">
                                <i class="fas fa-tools">&nbsp;</i>
                                <p>
                                    Configuración
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                @endif
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                HestiaDmin Controller By Riddo
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="https://fpymeatacama.cl" target="_blank">FpymeAtacama 2022</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <script src="{{ asset('public/lteadmin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/lteadmin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('public/lteadmin') }}/plugins/select2/js/select2.full.min.js"></script>
    <!--- Moment -->
    <script src="{{ asset('public/lteadmin') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/moment/moment-with-locales.min.js"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('public/lteadmin') }}/plugins/daterangepicker/daterangepicker.js"></script>



    <!-- SweetAlert2 -->
    <script src="{{ asset('public/lteadmin') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('public/lteadmin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Toastr -->
    <script src="{{ asset('public/lteadmin') }}/plugins/toastr/toastr.min.js"></script>


    <!-- AdminLTE App -->


    <script src="{{ asset('public/lteadmin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('public/lteadmin') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('public/utils') }}/app_informes.js"></script>

    <script>
        $(function() {
            $('.select2').select2();

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })




        })

        //Date range as a button


        $(document).ready(function() {
            $('.selectorEmpleados').select2();
            $('.selectorMeses').select2();
        });



        $('#fechaRegistro').daterangepicker({
            icons: {
                time: 'far fa-clock'
            },
            locale: moment.locale('es'),
        });

        $("#print").on("click", function(){
         $(this).css("display", "none");
         setTimeout(() => {
            $(this).css("display", "block");
         }, 2000);
        })
    </script>


    @yield('scripts')


</body>

</html>
