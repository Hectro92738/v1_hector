@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/panel_de_rh.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container">
        <div class="col-lg-16">
            <h3>Panel de RH</h3>
            
        </div>
    </div>
@endsection {{-- Fin del contenido del body  --}}
