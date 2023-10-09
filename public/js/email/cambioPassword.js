$(document).ready(function () {
    $("#mensajeAlerta").hide();
    $("#for_password_new").show();
    $("#mensaje_experado").hide();
    // Función para encriptar una cadena en SHA-256
    async function sha256(str) {
        const encoder = new TextEncoder();
        const data = encoder.encode(str);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        return hashHex;
    }
    // Obtener la fecha actual en formato "dd-mm-yyyy"
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    var fechaActual = /* '09-10-2023'; */dd + '-' + mm + '-' + yyyy;
    console.log('Fecha actual:', fechaActual); //ibtener fecha del servidor (actual)

    var horaActual = HoraActual(); //obtener Hora del servidor (actual)
    console.log('Hora actual:', horaActual);
    //---------------------------------------------------------------
    var hora = obtenerValorDanger(); //obtener hora de URL
    console.log('Hora de URl:', hora);

    var token = obtenerTokenDeURL(); //obtener fecha del URL (encriptada)
    console.log('Fecha de URl:', token);

    var correo = obtenerParametroDeURL('cambio'); //obtener email de URL
    console.log('correo:', correo);
    //---------------------------------------------------------------
    // Calcular la diferencia en horas entre "hora" y "horaActual"
    var diferenciaHoras = calcularDiferenciaHoras(hora, horaActual);
    //console.log('Diferencia en horas:', diferenciaHoras);

    const diferenciaHorass = diferenciaHoras;
    const diferenciaFormateada = formatTimeDifference(diferenciaHorass);
    console.log(`Diferencia en horas: ${diferenciaFormateada}`);

    //---------------------------------------------------------------
    // Encriptar la fecha actual en SHA-256
    sha256(fechaActual).then(hash => {
        if (hash != token) {
            $("#for_password_new").hide();
            $("#mensaje_experado").show();
        } if (diferenciaHoras > 5) {
            $("#for_password_new").hide();
            $("#mensaje_experado").show();
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //------------------------------------------------------------------------------
    var formatoContrasena = /^(?=.*[A-Z])(?=.*[a-z])(?!.*[^a-zA-Z0-9]).{8,}$/;
    $(document).on("submit", "#form_cambio_Password", function (e) {
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
                    error_formulario("modal-newPassword", "Formato incorrecto (minimo 8 caracteres y Mayusculas)");
                    return false;
                } else
                    if ($("#modal-newPassword").val() !== $("#modal-confirmPassword").val()) {
                        error_formulario("modal-confirmPassword", "Las contraseñas no coinciden");
                        error_formulario("modal-newPassword", "Las contraseñas no coinciden");
                        return false;
                    }
        $.ajax({
            url: eupdatePasswordRoute, // Asegúrate de definir esta ruta en tus rutas web.php
            dataType: 'json',
            method: 'POST',
            data: {
                correo: correo,
                password: $("#modal-newPassword").val(),
                _token: $('input[name="_token"]').val()
            },
            success: function (response) {
                if (response.status == 200) {
                    $("#mensajeAlerta").show();
                    var msj = response.msj;
                    var mensaje = document.querySelector('#mensajee');
                    mensaje.innerHTML = msj;
                    setTimeout(function () {
                        window.location.href = `http://127.0.0.1:8000/`;
                        //setInterval(actualizar, 1000);
                    }, 8000);
                } else {
                    alerta("danger", response.msj);
                }
            }
        });

    });
});
function obtenerTokenDeURL() {
    // Obtén la URL actual
    var url = window.location.href;
    // Encuentra el índice del signo de interrogación que separa la URL de la cadena de consulta
    var queryIndex = url.indexOf('?');
    if (queryIndex !== -1) {
        // Obtén la cadena de consulta después del signo de interrogación
        var queryString = url.substring(queryIndex + 1);
        // Divide la cadena de consulta en pares clave-valor
        var queryParams = queryString.split('&');
        // Inicializa una variable para almacenar el token
        var token = null;
        // Itera a través de los pares clave-valor
        for (var i = 0; i < queryParams.length; i++) {
            var param = queryParams[i].split('=');
            if (param[0] === 'teken') {
                token = param[1];
                break;
            }
        }
        // Retorna el token
        return token;
    }
    // Retorna null si no se encuentra el token
    return null;
}
function obtenerParametroDeURL(nombreParametro) {
    // Obtén la URL actual
    var url = window.location.href;
    // Encuentra el índice del signo de interrogación que separa la URL de la cadena de consulta
    var queryIndex = url.indexOf('?');
    if (queryIndex !== -1) {
        // Obtén la cadena de consulta después del signo de interrogación
        var queryString = url.substring(queryIndex + 1);
        // Divide la cadena de consulta en pares clave-valor
        var queryParams = queryString.split('&');
        // Busca el parámetro deseado en los pares clave-valor
        for (var i = 0; i < queryParams.length; i++) {
            var param = queryParams[i].split('=');
            if (param[0] === nombreParametro) {
                // Retorna el valor del parámetro encontrado
                return param[1];
            }
        }
    }
    // Retorna null si el parámetro no se encuentra
    return null;
}
function obtenerValorDanger() {
    // Obtener la URL actual
    var url = window.location.href;
    // Crear un objeto URL con la URL actual
    var urlObj = new URL(url);
    // Obtener el valor del parámetro 'danger' de la URL
    var danger = urlObj.searchParams.get('danger');
    // Devolver el valor
    return danger;
}
function HoraActual() {
    var today = new Date();
    var hh = String(today.getHours()).padStart(2, '0');
    var min = String(today.getMinutes()).padStart(2, '0');
    var ss = String(today.getSeconds()).padStart(2, '0');
    var HoraActual = hh + ':' + min + ':' + ss;
    return HoraActual;
}
// Función para calcular la diferencia en horas entre dos horas en formato "HH:mm"
function calcularDiferenciaHoras(hora1, hora2) {
    var [hh1, mm1] = hora1.split(':').map(Number);
    var [hh2, mm2] = hora2.split(':').map(Number);

    // Calcular la diferencia en minutos
    var minutos1 = hh1 * 60 + mm1;
    var minutos2 = hh2 * 60 + mm2;
    var diferenciaMinutos = Math.abs(minutos1 - minutos2);
    // Convertir la diferencia de minutos a horas
    var diferenciaHoras = diferenciaMinutos / 60;

    return diferenciaHoras;
}
function formatTimeDifference(hours) {
    const hoursPart = Math.floor(hours);
    const minutesPart = Math.round((hours - hoursPart) * 60);
    return `${hoursPart} horas ${minutesPart} minutos`;
}
