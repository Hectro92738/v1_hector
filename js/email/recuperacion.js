$(document).ready(function () {
    // Obtén los elementos de iconos y mensajes
    const helpIcon = document.getElementById("help-icon");
    const helpMessage = document.getElementById("help-message");
    manejarAyuda(helpIcon, helpMessage);

    var formatoCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    $(document).on("submit", "#form_token", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-email").val() == "") {
            error_formulario("modal-email", "El campo no puede ir vacío");
            return false;
        } else
            if (!formatoCorreo.test($("#modal-email").val())) {
                error_formulario("modal-email", "Formato Incorrecto de Email");
                return false;
            }
        $.ajax({
            url: verificaEmailExisteRoute,
            method: 'POST',
            dataType: 'json',
            data: {
                email: $("#modal-email").val(),
                _token: $('input[name="_token"]').val()
            },
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj)
                    envioURL();
                } else {
                    alerta("danger", response.msj)
                }
            },
            error: function () {
                error_ajax();
            }
        });
    });
});
function envioURL() {
    $.ajax({
        //http://172.31.192.78/Recuperacion_password/envioGmail.php
        //http://localhost/envio/envioGmail.php
        url: 'http://localhost/envio/envioGmail.php',
        method: 'POST',
        dataType: 'json',
        data: {
            email: $("#modal-email").val(),
            fecha: fechaActual(),
            hora: HoraActual()
        },
        success: function () {
            window.location.href = `${indexRoute}`;
        },
        error: function () {
            //error_ajax();
        }
    });
};
