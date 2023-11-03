$(document).ready(function () {
    var correo = appData.email;
    Menu(appData.numEmp);
    obtenerAvatar(appData.numEmp, "#avatar", "30", "30", "rounded-circle");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // Llama a la función cerrarSesion cada 1hora
    setInterval(cerrarSesion, 3600000);

    $("#salir").click(function () {
        alerta("danger", "Sesión Finalizada");
        setTimeout(function () {
            cerrarSesion();
        }, 1000);
    });
    //----------------------------------------------------------------
    obtenerNombreEmpleado(correo)
        .then(function (response) {
            var nombreUsuario = response.nombre;
            var bienvenidaElement = document.querySelector("#nombre");
            bienvenidaElement.innerHTML = nombreUsuario;
        })
        .catch(function (error) {
        });


        
});
