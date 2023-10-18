@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/documentos_personales.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container py-4">
        <div class="container">
            <span id="info"></span>
        </div>
    </div>
@endsection {{-- Fin del contenido del body  --}}
