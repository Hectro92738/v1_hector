@extends('layouts.header') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/login_cambioPass.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    @include('navbar') {{-- Incluye el archivo de navegación --}}
    <div class="container">
        <div class="row py-5">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md-6 mt-3">
                <h2>Crea una Contraseña</h2>
                <form id="form_cambio_Password"> {{-- method="POST" action="{{ route('login') }} --}}
                    @csrf
                    <div id="emailHelp" class="form-text">Utiliza el siguiente formulario para cambiar tu
                        contraseña. Asegúrate de elegir una contraseña segura y recuérdala bien. Después de cambiar
                        tu contraseña, podrás acceder a tu cuenta con las nuevas credenciales.</div>
                    <div class="input-group mt-2" id="group-modal-newPassword">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                        <input type="password" id="modal-newPassword" name="modal-newPassword" class="form-control"
                            placeholder="new pasword">
                    </div>
                    <div id="emailHelp" class="form-text">Password minimo de 8 caracteres</div>
                    <div class="input-group mt-3" id="group-modal-confirmPassword">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                        <input type="password" id="modal-confirmPassword" name="modal-confirmPassword" class="form-control"
                            placeholder="confirm Password">
                    </div>
                    <label for="show-password" class="custom-checkbox-label">
                        <input type="checkbox" id="show-passwords" class="custom-checkbox">
                        Mostrar Contraseña
                    </label>
                    <div class="form-group py-5">
                        <button type="submit" id="css-botonn" class="btn btn-block me-3">Ingresar</button>
                    </div>
                </form>
            </div>
            <!-- Sección del formulario -->
            <div class="col-md-6 mt-3">
                <h4 id="nombre"></h4>
                <p>Por razones de seguridad, debes de generar una contraseña a continuación.</p>
                <hr>
                <a class="navbar-brand py-3" href="#">
                    <img class="center-image" width="300" class="img-thumbnail"
                        src="{{ asset('images/LOGO_UTEQ2022_COMPLETO.png') }}" alt="">
                </a>
            </div>
        </div>
    </div>
    <div id="mensajeAlerta">
        <div class="alert alert-success d-flex flex-column position-fixed" role="alert"
            style="font-size: 15px; top: 10rem; left: 20px; right: 20px; transform: translateX(0); z-index: 2000;">
            <h4 class="alert-heading">¡Excelente!</h4>
            <p id="mensajee"></p>
            <hr>
            <div class="d-flex justify-content-center">
                Cargando <div class="me-2"></div>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection {{-- Fin del contenido del body  --}}
