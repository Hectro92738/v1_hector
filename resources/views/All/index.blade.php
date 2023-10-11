@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container">
        <div class="col-lg-16">
            <h3>CRUD AJAX</h3>
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Employee">
                        <i class="bi bi-box-seam-fill me-2"></i>Add Employee
                    </button>
                </div>
                <div class="card-body" id="show_all_employees">
                    <h1 class="text-center text-secondary my-5">Loading..</h1>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        <div class="modal fade" id="Employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST" id="add_employees_form" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="firt-name" class="form-label">Nombre</label>
                                <input type="text" name="fname" class="form-control" id="firt-name"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Ingrasa tu Nombre Completo</div>
                            </div>
                            <div class="mb-3">
                                <label for="last-name" class="form-label">Apellido</label>
                                <input type="text" name="lname" class="form-control" id="last-name"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Ingrasa tu Nombre Completo</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Ingrasa tu Correo Electronico</div>
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar</label>
                                <input type="File" name="avatar" class="form-control" id="avatar">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_employees_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL- ELIMINAR --}}
        <div class="modal fade" id="Employee_drop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deseas eliminar este producto!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Canselar</button>
                        <button type="submit" id="drop_producto" class="btn btn-danger">Eliminar <i
                                class="bi-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        {{-- MODAL-EDITAR --}}
        <div class="modal fade" id="modal-editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="contenido_detalle">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var storeRoute = '{{ route('store') }}' + '?token=' + appData.token;
        var fetchAllRoute = '{{ route('fetchAll') }}' + '?token=' + appData.token;
        var dropProductRoute = '{{ route('dropProduct') }}' + '?token=' + appData.token;
        var editProductoRoute = '{{ route('editProduct') }}' + '?token=' + appData.token;
        var updateProductRoute = '{{ route('updateProduct') }}' + '?token=' + appData.token;
    </script>
@endsection {{-- Fin del contenido del body  --}}
