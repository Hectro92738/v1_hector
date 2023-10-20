@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/panel_de_rh.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="row py-1" style="font-size: 14px">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <button class="btn bg-warning ms-2 mt-2" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#Modal_new_Menu">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <i class="bi bi-people fa-2x me-2"></i> MENU
                        </div>
                        <div class="col-md-16" style="overflow-y: auto; max-height: 400px;">
                            <div class="card-body">
                                <span id="imfo_menu"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sección del formulario -->
            <div class="col-md">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <button class="btn bg-warning ms-2 mt-3" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#Modal_new_SubMenu">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <i class="bi bi-people fa-2x me-2"></i>SUBMENU
                        </div>
                        <div class="col-md-16" style="overflow-y: auto; max-height: 400px;">
                            <div class="card-body">
                                <span id="imfo_submenu"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- MODAL - NEW - MENU --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="Modal_new_Menu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Crear nuevo Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="form_crea_menu" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group" id="group-modal-nombre">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" id="modal-nombre" name="modal-nombre" class="form-control"
                        placeholder="Nombre del Menú">
                </div>
                {{-- MENU - ICONOS  --}}
                <div class="form-check form-check-inline mt-4" id="" data-toggle="buttons">
                    <div class="icon-container" style="overflow-y: auto; max-height: 300px;">
                        <span class="group-modal-icono"></span>
                    </div>
                </div>
                <div class="form-group py-4">
                    <button type="submit" id="botonn" class="btn btn-block me-3"><i
                            class="bi bi-cloud-arrow-up h4"></i></button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL - NEW - SUBMENU --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="Modal_new_SubMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Crear nuevo Sub-Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="form_crea_submenu" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group" id="group-modal-nombre-sub">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" id="modal-nombre-sub" name="modal-nombre-sub" class="form-control"
                        placeholder="Nombre del Menú">
                </div>
                {{-- MENU - ICONOS  --}}
                <div class="form-check form-check-inline mt-4 " data-toggle="buttons">
                    <div class="icon-container" style="overflow-y: auto; max-height: 300px;">
                        <span class="group-modal-icono"></span>
                    </div>
                </div>
                <div class="form-group py-4">
                    <button type="submit" id="botonn" class="btn btn-block me-3"><i
                            class="bi bi-cloud-arrow-up h4"></i></button>
                </div>
            </form>
        </div>
    </div>
    {{-- MODAL ELIMINAR MENU --}}
    <div class="modal fade" id="drop_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Menú</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Realmente quiere eliminar este Menú .!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="eliminar_menu" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL ELIMINAR SUBMENU --}}
    <div class="modal fade" id="drop_submenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Sub-Menú</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Realmente quiere eliminar este Sub-Menú .!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="eliminar_submenu" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EDITAR MENU --}}
    <div class="modal fade" id="editar_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span id="nombre_menu"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_menu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span id="input_nomb_menu"></span>
                        {{-- MENU - ICONOS  --}}
                        <div class="form-check form-check-inline mt-4 " data-toggle="buttons">
                            <div class="icon-container" style="overflow-y: auto; max-height: 300px;">
                                <span class="group-modal-icono"></span>
                            </div>
                        </div>
                        <div class="form-group py-4">
                            <button type="submit" id="botonn" class="btn btn-block me-3"><i
                                    class="bi bi-cloud-arrow-up h4"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EDITAR SUBMENU --}}
    <div class="modal fade" id="modal_editar_submenu" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span id="nombre_submenu"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_submenu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span id="input_nomb_submenu"></span>
                        {{-- MENU - ICONOS  --}}
                        <div class="form-check form-check-inline mt-4 " data-toggle="buttons">
                            <div class="icon-container" style="overflow-y: auto; max-height: 300px;">
                                <span class="group-modal-icono"></span>
                            </div>
                        </div>
                        <div class="form-group py-4">
                            <button type="submit" id="botonn" class="btn btn-block me-3"><i
                                    class="bi bi-cloud-arrow-up h4"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        //------------------ Menu ------------------------------------
        var getMenuRoute = '{{ route('getMenu') }}' + '?token=' + appData.token;
        var getSubmenuRoute = '{{ route('getSubmenu') }}' + '?token=' + appData.token;
        var ubdateEstatusMenuRoute = '{{ route('ubdateEstatusMenu') }}' + '?token=' + appData.token;
        var ubdateEstatusSubmenuRoute = '{{ route('ubdateEstatusSubmenu') }}' + '?token=' + appData.token;
        var insertMenuRoute = '{{ route('insertMenu') }}' + '?token=' + appData.token;
        var insertSubMenuRoute = '{{ route('insertSubMenu') }}' + '?token=' + appData.token;
        var EliminarMenuRoute = '{{ route('EliminarMenu') }}' + '?token=' + appData.token;
        var EliminarSubMenuRoute = '{{ route('EliminarSubMenu') }}' + '?token=' + appData.token;
        var getMenuEditarRoute = '{{ route('getMenuEditar') }}' + '?token=' + appData.token;
        var getSubMenuEditarRoute = '{{ route('getSubMenuEditar') }}' + '?token=' + appData.token;
        var insertMenuEditadoRoute = '{{ route('insertMenuEditado') }}' + '?token=' + appData.token;
        var insertSubMenuEditadoRoute = '{{ route('insertSubMenuEditado') }}' + '?token=' + appData.token;
    </script>
@endsection {{-- Fin del contenido del body  --}}
