@extends('layouts.header') {{-- Encabezado de todas las paguinas --}}
@section('title', 'LOGIN') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
@endsection
@section('Js')
    <script src="{{ asset('js/inicio_sesion.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    @include('navbar') {{-- Incluye el archivo de navegación --}}
    <div class="container">
        <div class="row py-1">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md-6 mt-3">
                <a class="navbar-brand py-3" href="#">
                    <img class="center-image" width="150" class="img-thumbnail"
                        src="{{ asset('images/LOGO_UTEQ2022_COMPLETO.png') }}" alt="">
                </a>
                <hr>
                <h2 class="text-center py-3">Iniciar Sesión</h2>
                <p>Ingresa tus credenciales para poder ingresar</p>
                <form id="form_login" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group" id="group-modal-email">
                        <span class="input-group-text">@</span>
                        <input type="text" id="modal-email" name="modal-email" class="form-control"
                            placeholder="Correo Electrónico">
                        {{-- Icono de Ayuda --}}
                        <i id="help-icon" class="bi bi-question-circle  help-icon"></i>
                        <div class="help-message" id="help-message">
                            <p> <strong> Correo electronico</strong><br>
                                Ingresa tu correo Eléctronico Institucional UTEQ, ejemplo:
                                antonio45@uteq.edu.mx
                            </p>
                        </div>
                    </div>
                    <div class="input-group mt-4" id="group-modal-password">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="modal-password" name="modal-password" class="form-control"
                            placeholder="Password">
                        {{-- Icono de Ayuda --}}
                        <i id="help-iconPass" class="bi bi-question-circle  help-icon"></i>
                        <div class="help-message" id="help-messagePass">
                            <p> <strong>Password/Contraseña</strong><br>
                                Si es primera vez que quieres ingresar, ingresa tu número de empleado,
                                si ya has ingresado anteriormente con tu número de empleado entonces
                                ya has creado una contraseña, si no la recuerdas preciona en ¿Olvidó su contraseña?
                            </p>
                        </div>
                    </div>
                    <label for="show-password" class="custom-checkbox-label">
                        <input type="checkbox" id="show-password" class="custom-checkbox">
                        Mostrar Contraseña
                    </label>
                    <div class="form-group py-4">
                        <button type="submit" id="botonn" class="btn btn-block me-3">Iniciar Sesión</button>
                        <a class="button" href="{{ url('/email_recuperacion') }}">¿Olvidó su contraseña?</a>
                    </div>
                </form>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <!-- Sección del formulario -->
            <div id="contenedor_login" class=" col-md-6 mt-3">
                <p>"¡Bienvenidos al portal de inicio de sesión de la Universidad Tecnológica de Querétaro (UTEQ)! En nuestra
                    comunidad académica, reconocemos la importancia de nuestros dedicados maestros y empleados, quienes
                    desempeñan un papel fundamental en la formación de la próxima generación de líderes y profesionales.</p>
                <hr>
                <div id="carouselExampleCaptions" class=" text-dark carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/img-logo1.jpeg') }}" class="d-block w-100" alt="" loading="lazy">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/img-logo2.jpeg') }}" class="d-block w-100" alt="" loading="lazy">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/img-logo3.jpg') }}" class="d-block w-100" alt="" loading="lazy">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection {{-- Fin del contenido del body  --}}
