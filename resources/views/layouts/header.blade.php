<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/Logo_azul_UTEQ_1_1.png') }}">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/librerias/bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/librerias/bootstrap-css/css/bootstrap.css') }}">
    {{-- JAVASCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Enlace a Bootstrap JavaScript -->
    <script src="{{ asset('js/mensajes.js') }}"></script>
    <script src="{{ asset('js/librerias/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/librerias/bootstrap.bundle.min.js') }}"></script>
    @yield('Js')
    {{-- ---------- --}}
</head>

<body>
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
    <div>
        @yield('content')
    </div>
    <div id="mensaje" class="d-flex flex-column position-fixed"
        style="font-size: 12px; top: 8px; left: 36%; transform: translateX(-50%); z-index: 2000;"></div>
    <script>
        var loginRoute = '{{ route('login') }}'; //valida el pass y usu
        var indexRoute = '{{ url('/index') }}';
        var login_cambio_PaswordRoute = '{{ url('/login_cambio_Pasword') }}';
        var eupdatePasswordSecionRoute = '{{ route('eupdatePasswordSecion') }}' + '?token=' + appData.token;
        var getNameRoute = '{{ route('getName') }}' + '?token=' + appData.token;
        var verificaEmailExisteRoute = '{{ route('verificaEmailExiste') }}';
        var getAllEmpleadosRoute = '{{ route('getAllEmpleados') }}';
    </script>
    {{-- @include('footer')  --}} {{-- Incluye el archivo de navegación --}}
</body>

</html>
