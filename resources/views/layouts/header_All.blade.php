<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('chosen/chosen.css') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/librerias/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/librerias/bootstrap-css/css/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="icon" href="{{ asset('dist/img/favicon.ico') }}">
    <script src="{{ asset('js/librerias/jquery-3.6.3.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('chosen/chosen.jquery.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/css/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTables/js/jquery.dataTables.min.js') }}"></script>
    
    <script src="{{ asset('js/librerias/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/librerias/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/mensajes.js') }}"></script>
    @yield('Js')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- ANIMACIÓN DE CARGANDO --}}
    <div id="loading-container" class="loading-container">
        <div class="loading-spinner"></div>
    </div>
    <script>
        var appData = {
            email: '{{ request('email') }}',
            token: '{{ request('token') }}',
            numEmp: '{{ request('numEmp') }}',
            changePassword: '{{ request('changePassword') }}',
        };
    </script>
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/LOGO_AZUL_UTEQ.png') }}" alt="UTEQQLOGO"
                height="60" width="60">
        </div>
        @include('All.navbar_All')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4"
            style="background-color: rgb(18, 71, 115); font-size: 13px;">
            <!-- Brand Logo -->
            <a href="{{ url('/index') }}/{{ request('token') }}?email={{ request('email') }}&token={{ request('token') }}&numEmp={{ request('numEmp') }}"
                class="brand-link" style="background-color: rgb(252, 252, 253)">
                <img src="{{ asset('dist/img/LOGO_AZUL_UTEQ.png') }}" alt="UTEQ Logo" style="opacity: .8">
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" id="menu-container" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Aquí se insertarán los menús y submenús dinámicamente -->
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            {{-- MODAL- SALIR --}}
            <div class="modal fade" id="drop_sesion" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cerrar Sesión</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Estás seguro (a) de cerrar sesión
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="salir" class="btn btn-primary">Cerrar Sesión</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            @include('All.footer')
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <div id="mensaje" class="d-flex flex-column position-fixed"
        style="font-size: 12px; top: 8px; left: 36%; transform: translateX(-50%); z-index: 2000;"></div>
    <!-- ./wrapper -->
    <script>
        var indexRoute = '{{ url('/index') }}';
        var Route = '{{ url('/') }}'; //Cuando cierre sesión
        var logoutRoute = '{{ route('logout') }}'; //Cuando cierre sesión
        //------------------ Avatar ------------------------------------
        var getAvatarRoute = '{{ route('getAvatar') }}' + '?token=' + appData.token;
        var getNameRoute = '{{ route('getName') }}' + '?token=' + appData.token;
        //------------------ IMAGENES ------------------------------------
        var imgRoute = '{{ asset('storage/app/avatars/') }}'; //Ruta para obtener las imagenes del "STORAGE"
        var imagesRoute = '{{ asset('storage/app/images/') }}'; //Ruta para obtener las imagenes del "STORAGE"
        //------------------ Menu ------------------------------------
        var getMenuSubmenuRoute = '{{ route('getMenuSubmenu') }}' + '?token=' + appData.token; //Trae el Menú
        var getAllEmpleadosRoute = '{{ route('getAllEmpleados') }}' + '?token=' + appData.token; //Traetodos los empleados
        //------------------ Mandos ------------------------------------
        var getMandosRoute = '{{ route('getMandos') }}' + '?token=' + appData.token; //Traetodos los Mandos de la tabla "mandos"
        var getTotalEmpleadosRoute = '{{ route('getTotalEmpleados') }}' + '?token=' + appData.token; //Traetodos Total de Empleados de la estructura
        var getImgRoute = '{{ route('getImg') }}' + '?token=' + appData.token; 
        var conocertipousuariosRoute = '{{ route('conocertipousuarios') }}' + '?token=' + appData.token; 
    </script>
    {{-- <script src="{{ asset('chosen/docsupport/prism.js') }}"></script>
    <script src="{{ asset('chosen/docsupport/init.js') }}"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>

</html>
