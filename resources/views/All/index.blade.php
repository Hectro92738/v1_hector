@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/index.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container-sm">
        <div class="py-3">
            <div class="row">
                {{-- Left Column --}}
                <div class="col-md-6 py-3 py-md-5 ms-3 me-3">
                    <div class="d-flex flex-column justify-content h-100">
                        <h2 class="mb-4">¡Hola!, <span class="text-info" id="nombre_en_index"></span></h2>
                        <p>
                            Sabías que somos
                            <span class="text-info" id="total_empleados"></span>
                            empleados trabajando juntos. 😊
                        </p>
                    </div>
                </div>
                {{-- Right Column (you can add content here if needed) --}}
                <div class="col-md-5">
                    <div class="animacion-container mt-5">
                        <img id="img_action_2" class="animacion" loading="lazy" onclick="this.style.left='150px'">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="index">
    </div>

@endsection {{-- Fin del contenido del body  --}}
