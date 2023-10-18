$(document).ready(function () {
    var correo = appData.email;
    Menu(appData.numEmp);
    obtenerAvatar(appData.numEmp, "#avatar", "30", "30", "rounded-circle");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // Llama a la función cerrarSesion cada 15 minutos
    setInterval(cerrarSesion, 900000);
    $("#salir").click(function () {
        alerta("danger", "Sesión Finalizada");
        setTimeout(function () {
            cerrarSesion();
        }, 1000);
    });
    obtenerNombreEmpleado(correo);
});
