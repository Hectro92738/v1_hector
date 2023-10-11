@extends('layouts.header') {{-- Encabezado de todas las paguinas --}}
@section('title', 'Recuperación') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}">
@endsection
@section('Js')
    <script src="{{ asset('js/email/recuperacion.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    @include('navbar') {{-- Incluye el archivo de navegación --}}
    <div class="container">
        <div class="row py-1">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md-6 mt-3">
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
                            <img src="{{ asset('images/img-logo1.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/img-logo2.jpeg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/img-logo3.jpg') }}" class="d-block w-100" alt="...">
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
            <!-- Sección del formulario -->
            <div id="contenedor_login" class=" col-md-6 mt-3">
                <a href="{{ url('/') }}" id="backButton" class="btn btn-secondary btn-block"><i
                        class="bi bi-arrow-left-short fa-2x"></i></a>
                <a class="navbar-brand py-3" href="#">
                    <img class="center-image" width="150" class="img-thumbnail"
                        src="{{ asset('images/LOGO_UTEQ2022_COMPLETO.png') }}" alt="">
                </a>
                <hr>
                <div class="">
                    <h2 class="text-center">Recuperación de contraseña</h2>
                    <form id="form_token"> {{-- method="POST" action="{{ route('login') }} --}}
                        @csrf
                        <div id="emailHelp" class="form-text">"¡Bienvenido! Por favor ingresa tu correo electrónico
                            institucional en el campo proporcionado a
                            continuación. Te enviaremos un enlace de restablecimiento a tu correo electrónico
                            registrado.
                            Asegúrate de ingresar tu correo institucional para garantizar la seguridad de tu cuenta.
                            ¡Gracias!"</div>
                        <div class="input-group mt-4" id="group-modal-email">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" id="modal-email" name="modal-email" class="form-control"
                                placeholder="Email@uteq.edu.mx">
                            {{-- Icono de Ayuda --}}
                            <i id="help-icon" class="bi bi-question-circle  help-icon"></i>
                            <div class="help-message" id="help-message">
                                <p> <strong> Correo electronico</strong><br>
                                    Ingresa tu correo Eléctronico Institucional UTEQ, ejemplo:
                                    antonio45@uteq.edu.mx
                                </p>
                            </div>
                        </div>
                        <div class="form-group py-3">
                            <button type="submit" id="botonn" class="btn btn-block me-4">Enviar Token</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection {{-- Fin del contenido del body  --}}
