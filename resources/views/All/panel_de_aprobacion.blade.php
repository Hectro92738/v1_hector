@extends('layouts.header_All') {{-- Encabezado de todas las paguinas --}}
@section('title', 'XXHR-UTEQ') {{-- Uso de variables en cada documento en este caso en Titulo  --}}
@section('Js')
    <script src="{{ asset('js/All/panel_de_aprobacion.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
@endsection
@section('content') {{-- Dentro del body hemos llamado "content" la sección donde va a variar el contenido del body --}}
    <div class="container py-4">
        <div>
            <h6>Panel de aprobación</h6>
        </div>
        <table id="empleadosTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Acción</th>
                    <th>Emp.Número</th>
                    <th>Nom.Empleado</th>
                    <th>RFC</th>
                    <th>IMSS</th>
                    <th>Fech.Nacimiento</th>
                    <th>Organización</th>
                    <th>Dirección</th>
                    <th>Tipo.contrato</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                <span id="Cargando"></span>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal_empleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var getaprobacionRoute = '{{ route('getaprobacion') }}' + '?token=' + appData.token; 
    </script>
@endsection {{-- Fin del contenido del body  --}}
