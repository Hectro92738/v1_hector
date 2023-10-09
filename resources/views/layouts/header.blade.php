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
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis&family=Montserrat:ital,wght@1,300&family=Poppins:wght@300&family=Roboto:ital,wght@1,300&family=Ysabeau+SC:wght@1;100&display=swap"
        rel="stylesheet">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- JAVASCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Enlace a Bootstrap JavaScript -->
    <script src="{{ asset('js/mensajes.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    @yield('Js')
    {{-- ---------- --}}
</head>

<body>
    <script>
        var appData = {
            email: '{{ request('email') }}',
            token: '{{ request('token') }}',
            changePassword: '{{ request('changePassword') }}',
        };
    </script>
    <div>
        @yield('content')
    </div>
    <div id="mensaje" class="d-flex flex-column position-fixed"
        style="font-size: 12px; top: 8px; left: 30%; transform: translateX(-50%); z-index: 2000;"></div>
    <script>
        var loginRoute = '{{ route('login') }}'; //valida el pass y usu
        var CrudRoute = '{{ url('/Crud') }}';
        var indexRoute = '{{ url('/') }}'; //Cuando cierre sesión
        var logoutRoute = '{{ route('logout') }}'; //Cuando cierre sesión
        var login_cambio_PaswordRoute = '{{ url('/login_cambio_Pasword') }}';
        var eupdatePasswordSecionRoute = '{{ route('eupdatePasswordSecion') }}' + '?token=' + appData.token;
        var getNameRoute = '{{ route('getName') }}' + '?token=' + appData.token;
        var verificaEmailExisteRoute = '{{ route('verificaEmailExiste') }}';
    </script>
    @include('footer') {{-- Incluye el archivo de navegación --}}
</body>

</html>
