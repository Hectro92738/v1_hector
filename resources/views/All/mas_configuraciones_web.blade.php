@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/mas_configuraciones_web.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container py-4">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    {{-- Left Column --}}
                    <div class="col-md-5 py-3 py-md-5 ms-3 me-3">
                        <div class="d-flex flex-column justify-content h-100">
                            <h2 class="mb-4">¡Agrega una imagen!</h2>
                            <form id="form_insert_img" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="input-group mt-4" id="group-modal_img">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-image-fill"></i></span>
                                    <input type="file" id="modal_img" name="modal_img" class="form-control"
                                        placeholder="Imagen">
                                </div>

                                <div class="form-group py-4" id="group-modal_img_animacion">
                                    <select class="form-select mb-3" id="modal_img_animacion" name="modal_img_animacion">
                                        <option value="">Seleciona una obción</option>
                                        <option value="1">Imagen para Fondo</option>
                                        <option value="2">Imagen de Animación</option>
                                    </select>
                                </div>

                                <div class="form-group py-4">
                                    <button type="submit" id="botonn" class="btn btn-primary btn-block me-3">Subir
                                        Imagen</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    {{-- Right Column (you can add content here if needed) --}}
                    <div class="col-md-5">
                        <div class="d-flex flex-column justify-content h-100">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Imagen de fondo</p>
                                    <span id="img_action_1"></span>
                                </div>
                                <div class="col-md-6"> 
                                    <p>Imagen de animación</p>
                                    <span id="img_action_2"></span>
                                    <p><span style="font-size: 10px">500px y 300px</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var inretIMGRoute = '{{ route('inretIMG') }}' + '?token=' + appData.token;
    </script>
@endsection {{-- Fin del contenido del body  --}}
