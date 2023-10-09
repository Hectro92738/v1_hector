@extends('layouts.header') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    @include('navbarRoles') {{-- Incluye el archivo de navegación --}}
    <div class="container">
        <h4>Hector</h4>
    </div>
@endsection {{-- Fin del contenido del body  --}}
