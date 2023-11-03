$(function () {
    var correo = appData.email;
    //----------------------PROMESA------------------------------------------
    obtenerNombreEmpleado(correo)
        .then(function (response) {
            var nombreUsuario = response.nombre;
            var bienvenidaElement = document.querySelector("#nombre_en_index");
            bienvenidaElement.innerHTML = nombreUsuario;
        })
        .catch(function (error) {});
    //----------------------PROMESA------------------------------------------
    obtenerTotalEmpleado()
        .then(function (response) {
            var totalEmpleados = response.totalEmpleados;
            var totalEmpleadosElement =
                document.querySelector("#total_empleados");
            totalEmpleadosElement.innerHTML = totalEmpleados;
        })
        .catch(function (error) {});
    //----------------------PROMESA------------------------------------------
    get_imagenes()
        .then(function (response) {
            // Filtrar las imágenes con ACTION igual a 2
            const imagenes = response.datos;
            const Action2 = imagenes.find((dato) => dato.ACTION == "2");

            if (Action2) {
                // La imagen con ACTION igual a 2 existe
                const img = Action2.IMG;
                var imgElement = document.querySelector("#img_action_2");
                var imgR = imagesRoute + "/" + img; // Ruta dinámica

                // Cambia el atributo src de la imagen
                imgElement.src = imgR;
            } else {
                // No se encontró ninguna imagen con ACTION igual a 2
                console.log("No se encontró una imagen con ACTION igual a 2");
            }
        })
        .catch(function (error) {
            // Manejar errores de la promesa
            console.log("Error al obtener las imágenes:", error);
        });
    //----------------------PROMESA------------------------------------------
    get_imagenes()
    .then(function (response) {
        const imagenes = response.datos;
        const Action1 = imagenes.find((dato) => dato.ACTION == "1");

        if (Action1) {
            const img = Action1.IMG;
            var imgElement = document.querySelector(".index");
            imgElement.style.backgroundImage = `url('../storage/app/images/${img}')`;
        } else {
            console.log("No se encontró una imagen con ACTION igual a 1");
        }
    })
    .catch(function () {
        console.log("Error al obtener las imágenes:");
    });

});
