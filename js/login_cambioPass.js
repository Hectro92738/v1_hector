$(document).ready(function () {
    var numEmp = appData.numEmp;
    console.log(numEmp);
    VisibilityPassword('show-passwords', ['modal-newPassword','modal-confirmPassword']);
    //---------------------------------------------------------------------------
    $("#mensajeAlerta").hide();
    var correo = appData.email;
    console.log(correo);
    $.ajaxSetup({//configuración global de AJAX en jQuery utilizando $.ajaxSetup()
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({//obtener el nombre del empleado
        url: getNameRoute,
        dataType: 'json',
        method: 'POST',
        data: {
            correo: correo,
        },
        success: function (response) {
            if (response.status == 700) {
                cerrarSesion();
            }
            var nombreUsuario = response.nombre;
            var bienvenidaElement = document.querySelector('#nombre');
            bienvenidaElement.innerHTML = 'Bienvenid(@), ' + nombreUsuario;
        },
        error: function () {
            error_ajax();
        },
    });
    //------------------------------------------------------------------------------
    //var formatoContrasena = /^(?=.*[A-Z])(?=.*[a-z])(?!.*[^a-zA-Z0-9]).{8,}$/;
    var formatoContrasena = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/;
    $(document).on("submit", "#form_cambio_Password", function (e) {//Crear contraseña por primera véz
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-newPassword").val() == "") {
            error_formulario("modal-newPassword", "El campo no puede ir vacío");
            return false;
        } else
            if ($("#modal-confirmPassword").val() == "") {
                error_formulario("modal-confirmPassword", "El campo no puede ir vacío");
                return false;
            } else
                if (!formatoContrasena.test($("#modal-newPassword").val())) {
                    error_formulario("modal-newPassword", "Formato incorrecto (minimo 8 caracteres, Mayusculas, Minisculas, Números)");
                    return false;
                } else
                    if ($("#modal-newPassword").val() !== $("#modal-confirmPassword").val()) {
                        error_formulario("modal-confirmPassword", "Las contraseñas no coinciden");
                        error_formulario("modal-newPassword", "Las contraseñas no coinciden");
                        return false;
                    }
        $.ajax({
            url: eupdatePasswordSecionRoute, // Asegúrate de definir esta ruta en tus rutas web.php
            dataType: 'json',
            method: 'POST',
            data: {
                correo: correo,
                password: $("#modal-newPassword").val(),
                _token: $('input[name="_token"]').val()
            },
            success: function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                } else
                    if (response.status == 200) {
                        $("#mensajeAlerta").show();
                        var msj = response.msj;
                        var mensaje = document.querySelector('#mensajee');
                        mensaje.innerHTML = msj;
                        setTimeout(function () {
                            window.location.href = `${indexRoute}/${appData.token}?email=${appData.email}&token=${appData.token}&numEmp=${numEmp}`;
                            //setInterval(actualizar, 1000);
                        }, 8000);
                    } else {
                        alerta("danger", response.msj);
                    }
            },
            error: function () {
                error_ajax();
            },
        });

    });
});