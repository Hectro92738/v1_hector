$(function () {
    $(document).on("submit", "#form_insert_img", function (e) {
        e.preventDefault();
        borra_mensajes();

        if ($("#modal_img").val() == "") {
            error_formulario("modal_img", "El campo no puede ir vacío");
            return false;
        }
        if ($("#modal_img_animacion").val() == "") {
            error_formulario(
                "modal_img_animacion",
                "El campo no puede ir vacío"
            );
            return false;
        }
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: inretIMGRoute,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 2000);
                } else if (response.status == 700) {
                    cerrarSesion();
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //----------------------PROMESA------------------------------------------
    get_imagenes()
        .then(function (response) {
            // Filtrar las imágenes con ACTION igual a 1
            const imagenes = response.datos;
            const Action1 = imagenes.find((dato) => dato.ACTION == "1");

            if (Action1) {
                // La imagen con ACTION igual a 1 existe
                const img = Action1.IMG;
                var imgElement = document.querySelector("#img_action_1");
                var imgR = imagesRoute + "/" + img; // Ruta dinámica
                imgElement.innerHTML =
                    '<img src="' +
                    imgR +
                    '" width="50%" loading="lazy" alt="Imagen con ACTION igual a 1" />';
            } else {
                // No se encontró ninguna imagen con ACTION igual a 1
                console.log("No se encontró una imagen con ACTION igual a 1");
            }
        })
        .catch(function () {
            // Manejar errores de la promesa
            console.log("Error al obtener las imágenes:");
        });
    //----------------------PROMESA------------------------------------------
    get_imagenes()
        .then(function (response) {
            // Filtrar las imágenes con ACTION igual a 1
            const imagenes = response.datos;
            const Action1 = imagenes.find((dato) => dato.ACTION == "2");

            if (Action1) {
                // La imagen con ACTION igual a 1 existe
                const img = Action1.IMG;
                var imgElement = document.querySelector("#img_action_2");
                var imgR = imagesRoute + "/" + img; // Ruta dinámica
                imgElement.innerHTML =
                    '<img src="' +
                    imgR +
                    '" width="50%" loading="lazy" alt="Imagen con ACTION igual a 1" />';
            } else {
                // No se encontró ninguna imagen con ACTION igual a 1
                console.log("No se encontró una imagen con ACTION igual a 1");
            }
        })
        .catch(function () {
            // Manejar errores de la promesa
            console.log("Error al obtener las imágenes:");
        });
});
