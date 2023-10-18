$(function () {
    Menu(appData.numEmp);
    $.ajaxSetup({//configuración global de AJAX en jQuery utilizando $.ajaxSetup()
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //-------------------MOSTRAR - PRODUCTO--------------------------------------
    $.ajax({
        url: fetchAllRoute,
        method: 'get',
        dataType: 'json', // Specify JSON data type
        success: function (response) {
            // Muestra el valor del token en la consola
            console.log(appData);
            //console.log('Valor de appData.changePassword:', appData.changePassword);
            if (response.status == 200) {
                //--------------------------
                const employees = response.obj;
                let tableHtml = '<div class="table-responsive">' +
                    '<table class="table table-striped aling-middle">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>ID</th>' +
                    '<th>Avatar</th>' +
                    '<th>Name</th>' +
                    '<th>E-mail</th>' +
                    '<th>Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                employees.forEach(function (p) {
                    tableHtml += '<tr>' +
                        '<td>' + p.id + '</td>' +
                        '<td><img src="/storage/images/' + p.avatar + '" width="150" class="img-thumbnail rounder-circle"></td>' +
                        '<td>' + p.first_name + ' ' + p.last_name + '</td>' +
                        '<td>' + p.email + '</td>' +
                        '<td>' +
                        '<a href="#" id="btn-edita-pro" data-edita-pro="' + p.id + '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#modal-editar">Editar<i class="bi bi-pencil h4 me-3"></i></a>' +
                        '<a href="#" onclick="click_btn_borrar(' + p.id + ')" class="text-danger mx-1 deleteIcon" data-bs-toggle="modal" data-bs-target="#Employee_drop">Eliminar<i class="bi-trash h4"></i></a>' +
                        '</td>' +
                        '</tr>';
                });
                tableHtml += '</tbody></table></div>';
                $("#show_all_employees").html(tableHtml);
                //--------------------------
            } else if (response.status == 700) {
                cerrarSesion();
            } else {
                $("#show_all_employees").html('<h2 class="text-center text-secondary my-5">' + response.message + '</h2>');
            }
            //--------------------------
        },
        error: function () {
            error_ajax();
        }
    });
    //-------------------AGREGAR - PRODUCTO------------------------------------
    $("#add_employees_form").submit(function (e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employees_btn").text('Adding...');
        $.ajax({
            url: storeRoute,
            method: 'POST',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    setInterval(actualizar, 1000);
                } else
                    if (response.status == 700) {
                        cerrarSesion();
                    }
            },
            error: function () {
                error_ajax();
            }
        });
    });
    //----------------------ELIMINAR - PRODUCTO---------------------------------
    $("#drop_producto").click(function () {
        $.ajax({
            url: dropProductRoute,
            dataType: "json",
            type: "POST",
            data: {
                id: appData.id_drop
            }
        })
            .done(function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                } else if (response.status == 200) {
                    alerta("success", response.msj);
                    setTimeout(function () {
                        setInterval(actualizar, 1000);
                    }, 1000);
                } else {
                    alerta("danger", response.msj);
                }
            })
            .fail(error_ajax);
    });
    //--------------------- MODAL- MOSTRAR - PRODUCTO---------------------------
    $(document).on("click", "#btn-edita-pro", function () {
        var idpro = $(this).data("edita-pro");
        $("#contenido_detalle").empty(); // Limpia el contenido anterior antes de agregar el nuevo contenido.
        $.ajax({
            url: editProductoRoute,
            dataType: "json",
            type: "post",
            data: {
                id: idpro
            }
        })
            .done(function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                }
                // Accede a los datos del producto utilizando response.obj
                var product = response.obj;
                var compraHTML =
                    '<form id="form_edit" data-id="' + product.id + '" enctype="multipart/form-data">' +
                    '<div class="mb-3">' +
                    '<label for="" class="form-label">Nombre</label>' +
                    '<input type="text" value="' + product.first_name + '" class="form-control" name="first_name">' +
                    '</div>' +
                    '<div class="mb-3">' +
                    '<label for="" class="form-label">Apellidos</label>' +
                    '<input type="text" value="' + product.last_name + '" class="form-control" name="last_name">' +
                    '</div>' +
                    '<div class="mb-3">' +
                    '<label for="" class="form-label">Gmail</label>' +
                    '<input type="text" value="' + product.email + '" class="form-control" name="email">' +
                    '</div>' +
                    '<div class="mb-3">' +
                    '<label for="" class="form-label">Avatar</label>' +
                    '<input type="file" class="form-control" name="avatar" >' +
                    '</div>' +
                    '<img src="/storage/images/' + product.avatar + '" width="150" class="img-thumbnail rounder-circle"></img>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                    '<button type="submit" class="btn btn-primary">Submit</button>' +
                    '</div>' +
                    '</form>';
                $("#contenido_detalle").append(compraHTML);
            })
            .fail(function () {
                error_ajax();
            });
    });
    //--------------------- EDITAR - PRODUCTO---------------------------
    $(document).on("submit", "#form_edit", function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        var id = $(this).data('id'); // Obtén el id del atributo data-id
        formData.append('id', id); // Agrega el id a los datos del formulario
        $.ajax({
            url: updateProductRoute, // Asegúrate de definir esta ruta en tus rutas web.php
            dataType: 'json',
            method: 'POST',
            data: formData,
            contentType: false, // Importante para enviar datos multipartes
            processData: false, // Importante para enviar datos multipartes
            success: function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                }
                setInterval(actualizar, 1000);
            },
            error: function () {
                error_ajax();
            },
        });
    });

});//FIN DEL DOCUMENTO
function click_btn_borrar(id) {//Guardar id para borrar producto
    appData.id_drop = id;
}

