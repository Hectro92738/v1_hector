<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/Logo_azul_UTEQ_1_1.png') }}">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- JAVASCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Enlace a Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/email/cambioPassword.js') }}"></script>
    <script src="{{ asset('js/mensajes.js') }}"></script>
</head>

<body>
    <div class="container">
        <div id="for_password_new" class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="login-form">
                    <a class="navbar-brand py-3" href="#">
                        <img class="center-image" width="200" class="img-thumbnail"
                            src="{{ asset('images/LOGO_UTEQ2022_COMPLETO.png') }}" alt="">
                    </a>
                    <h2 class="text-center py-3">Cambio de Contraseña</h2>
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
                        <div class="input-group mt-3"  id="group-modal-confirmPassword">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
                            <input type="password" id="modal-confirmPassword" name="modal-confirmPassword" class="form-control"
                                placeholder="confirm Password">
                        </div>
                        <div id="emailHelp" class="form-text">Repite tu password</div>
                        <div class="form-group py-5">
                            <button type="submit" class="btn btn-primary btn-block me-4">Cambiar Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="mensaje_experado">
            <div class="alert alert-danger d-flex align-items-center mt-5" role="alert">
                <i class="bi bi-exclamation-circle h1 me-3"></i>
                <div>
                    "¡Lo siento! La URL que intentas acceder ha caducado o ya no es válida. Por favor, asegúrate de
                    utilizar
                    el enlace más reciente proporcionado. Si sigues
                    experimentando problemas, comunícate con el administrador del sistema o el equipo de soporte para
                    obtener asistencia adicional."
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
    </div>
    <div id="mensaje" class="d-flex flex-column position-fixed" style="top: 20px; left: 50%; transform: translateX(-50%); z-index: 1050;"></div>  
    <script>
        var eupdatePasswordRoute = '{{ route('eupdatePassword') }}';
    </script>
</body>
</html>
