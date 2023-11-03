@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/configuracion_de_roles.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/All/configuracion_de_roles_2.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}{{-- multiple --}}
    <div class="container">
        <div class="card ">
            <div class="card-header">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <button id="Menu_todos" class="btn btn-info btn-sm me-2">Todos</button>
                                </li>
                                <li class="nav-item">
                                    <button id="Menu_mandos" class="btn btn-info btn-sm me-2">Mandos</button>
                                </li>
                                <li class="nav-item">
                                    <button id="Menu_base" class="btn btn-info btn-sm me-2">Base</button>
                                </li>
                                <li class="nav-item">
                                    <button id="Menu_confianza" class="btn btn-info btn-sm me-2">Confianza</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <select class="form-control chosen-select" id="alumnos-select"></select>
                    <button class="btn btn-primary btn-sm ms-2" id="buscar_menu_empleado"><i class="bi bi-search"></i></button>
                </nav>
            </div>
            <div>
                <span id="mon_menu_estatico"></span>
                <div class="row" id="menuForm"></div>
                <div class="py-4">
                    <button id="btn_menus" type="button" class="btn btn-primary btn-sm me-3 ms-3">Guardar Menú</button>
                    <button id="btn_menus_estaticos" type="button" class="btn btn-info btn-sm me-3 ms-3">Guardar Menú</button>
                    <button id="canselar_menus" type="button" class="btn btn-secondary btn-sm me-3 ms-3">Cancelar</button>
                </div>
            </div>
        </div>
        <div class="row py-1 mt-3" style="font-size: 14px">
            <!-- Sección de bienvenida y mensaje -->
            <div class="col-md">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <button class="btn bg-warning ms-2 mt-2" type="button" data-bs-toggle="modal"
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
                                <table id="miTabla" class="display" style="width:100%"></table>
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
                            <button class="btn bg-warning ms-2 mt-3" type="button" data-bs-toggle="modal"
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
        <div class="card mt-4">
            <div class="card-header">
                Mandos...!
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------------------------------------------------------------------- --}}
    {{-- MODAL - NEW - MENU --}}
    <div class="modal fade" id="Modal_new_Menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Crear nuevo Menù</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL - NEW - SUBMENU --}}
    <div class="modal fade" id="Modal_new_SubMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Crear nuevo Sub-Menú</strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
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
        //---------------------- Menu ------------------------------------
        //----------------------------------------------------------------
        //-----------TRAE LOS MENÚS Y SUBMENÚS CADA UNO POS SU TABLA------
        var getMenuRoute = '{{ route('getMenu') }}' + '?token=' + appData.token;
        var getSubmenuRoute = '{{ route('getSubmenu') }}' + '?token=' + appData.token;
        //----------------------------------------------------------------
        var ubdateEstatusMenuRoute = '{{ route('ubdateEstatusMenu') }}' + '?token=' + appData.token;
        var ubdateEstatusSubmenuRoute = '{{ route('ubdateEstatusSubmenu') }}' + '?token=' + appData.token;
        //----------------------------------------------------------------
        var insertMenuRoute = '{{ route('insertMenu') }}' + '?token=' + appData.token;
        var insertSubMenuRoute = '{{ route('insertSubMenu') }}' + '?token=' + appData.token;
        //----------------------------------------------------------------
        var EliminarMenuRoute = '{{ route('EliminarMenu') }}' + '?token=' + appData.token;
        var EliminarSubMenuRoute = '{{ route('EliminarSubMenu') }}' + '?token=' + appData.token;
        //----------------------------------------------------------------
        var getMenuEditarRoute = '{{ route('getMenuEditar') }}' + '?token=' + appData.token;
        var getSubMenuEditarRoute = '{{ route('getSubMenuEditar') }}' + '?token=' + appData.token;
        //----------------------------------------------------------------
        var insertMenuEditadoRoute = '{{ route('insertMenuEditado') }}' + '?token=' + appData.token;
        var insertSubMenuEditadoRoute = '{{ route('insertSubMenuEditado') }}' + '?token=' + appData.token;
        //TREA LOS MENÚS Y SUBMENÚS DE LA TABLA "menu_submenu" por el EMP_NUM CON ES ESTAUS "A" Y "I"
        var getmenuempleadoRoute = '{{ route('getmenuempleado') }}' + '?token=' + appData.token;
        //INSERTA A LA TABLA "menu_submenu" por el EMP_NUM LAS ACTUALIZACIONES DE LOS MENÚS Y SUBMENÚS
        var insertMenusEditadoRoute = '{{ route('insertMenusEditado') }}' + '?token=' + appData.token;
    </script>
@endsection {{-- Fin del contenido del body  --}}
