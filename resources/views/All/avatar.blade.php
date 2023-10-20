@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/avatar.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container p-2">
        <div class="row py-1">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md-6 mt-3">
                <h4> <i class="bi bi-image-alt h3 me-4"></i>Fotografía de Perfil</h4><br>
                <div class="card text-bg-dark">
                    <span id="avatar2"></span>
                    <div class="card-img-overlay">
                        <div id="btn_delete_avatar">
                            <button style="width: 40px;" data-bs-toggle="modal" data-bs-target="#delete_Avatar"
                                class="btn btn-danger btn-block me-3"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sección del formulario -->
            <div id="contenedor_login" class=" col-md-6 mt-2">
                <form id="form_avatar" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="input-group mt-4" id="group-modal_avatar">
                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-image-fill"></i></span>
                        <input type="file" id="modal_avatar" name="modal_avatar" class="form-control" placeholder="file">
                        {{-- Icono de Ayuda --}}
                        <i id="help-icon" class="bi bi-question-circle  help-icon"></i>
                        <div class="help-message" id="help-message">
                            <p> <strong>Avatar/Imagen</strong><br>
                                Carga una imagen para colocar como Avatar/Perfil
                            </p>
                        </div>
                    </div>
                    <div class="form-group py-4">
                        <button type="submit" id="botonn" class="btn btn-block me-3">subir imagen</button>
                    </div>
                </form>
                <p class="card-text mt-4">
                    "La imagen de perfil se utilizará como su avatar en la plataforma. Por favor, suba una imagen
                    que cumpla con nuestras políticas de uso y que represente adecuadamente su identidad en línea.
                    Las imágenes inapropiadas o que violen nuestras directrices serán eliminadas."
                </p>
            </div>
        </div>
    </div>
    {{-- MODAL- ELIMINAR --}}
    <div class="modal fade" id="delete_Avatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Avatar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Estás seguro(a) de eliminar tu Avatar!!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="elimina_avatar" class="btn btn-danger">Eliminar <i
                            class="bi-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <script>
        //------------------ Avatar ------------------------------------
        var insertAvatarRoute = '{{ route('insertAvatar') }}' + '?token=' + appData.token;
        var delateAvatarRoute = '{{ route('delateAvatar') }}' + '?token=' + appData.token;
    </script>
@endsection {{-- Fin del contenido del body  --}}
