$(document).ready(function () {
    $("#loading-container").hide();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
function error_formulario(campo, mensaje) {
    $("#group-" + campo).append(
        $("<div>", {
            class: "invalid-feedback",
            text: mensaje,
        })
    );
    $("#" + campo)
        .addClass("is-invalid")
        .focus();
}
function borra_mensajes() {
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();
}
function error_ajax() {
    //alerta("danger", "☠️");
    //setInterval(actualizar, 1000);
}
function alerta(tipo, mensaje) {
    switch (tipo) {
        case "success":
            icono = "bi bi-check2-circle";
            claseAlerta = "custom-success";
            break;
        case "info":
            icono = "bi bi-exclamation-lg";
            claseAlerta = "custom-info";
            break;
        case "danger":
            icono = "bi bi-exclamation-circle";
            claseAlerta = "custom-danger";
            break;
    }
    $("#mensaje").append(
        '<div class="alert ' +
            claseAlerta +
            ' alert-dismissible fade show" role="alert"><i class="' +
            icono +
            ' h4"></i> ' +
            mensaje +
            "</div>"
    );

    setTimeout(function () {
        $(".alert-dismissible").fadeOut(1000, function () {
            $(this).remove();
        });
    }, 2000);
}
function actualizar() {
    $("#loading-container").show();
    setTimeout(function () {
        location.reload(true);
    }, 2000);
}
function fecha_fancy(sFecha) {
    const ames = [
        "ene",
        "feb",
        "mar",
        "abr",
        "may",
        "jun",
        "jul",
        "ago",
        "sep",
        "oct",
        "nov",
        "dic",
    ];

    // recibe fecha en formato yyyy-mm-dd
    aFecha = sFecha.split("-");

    return aFecha[2] + "-" + ames[aFecha[1] - 1] + "-" + aFecha[0];
}
function manejarAyuda(icono, mensaje) {
    icono.addEventListener("click", function () {
        if (mensaje.style.display === "block") {
            mensaje.style.display = "none";
        } else {
            mensaje.style.display = "block";
        }
        setTimeout(function () {
            mensaje.style.display = "none";
        }, 15000);
    });

    document.addEventListener("click", function (event) {
        if (event.target !== mensaje && event.target !== icono) {
            mensaje.style.display = "none";
        }
    });
}
function cerrarSesion() {
    $.ajax({
        url: logoutRoute,
        method: "POST",
        success: function () {
            document.cookie =
                "session_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie =
                "user_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            delete appData.email;
            delete appData.token;
            window.location.href = `${Route}`;
        },
        error: function () {
            setInterval(actualizar, 1000);
        },
    });
}
function HoraActual() {
    var today = new Date();
    var hh = String(today.getHours()).padStart(2, "0");
    var min = String(today.getMinutes()).padStart(2, "0");
    var ss = String(today.getSeconds()).padStart(2, "0");
    var HoraActual = hh + ":" + min + ":" + ss;
    return HoraActual;
}
function fechaActual() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();
    var fechaActual = dd + "-" + mm + "-" + yyyy;
    return fechaActual;
}
function VisibilityPassword(checkboxId, passwordIds) {
    var $showPasswordCheckbox = $("#" + checkboxId);

    $showPasswordCheckbox.change(function () {
        var isChecked = $(this).is(":checked");
        passwordIds.forEach(function (passwordId) {
            var $passwordInput = $("#" + passwordId);
            $passwordInput.attr("type", isChecked ? "text" : "password");
        });
    });
}
function obtenerNombreEmpleado(correo) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getNameRoute,
            dataType: "json",
            method: "POST",
            data: {
                correo: correo,
            },
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                }
                if (response.status == 200) {
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function obtenerAvatar(numEmp, id, width, height, css) {
    $.ajax({
        url: getAvatarRoute,
        dataType: "json",
        method: "POST",
        data: {
            numEmp: numEmp,
        },
        success: function (response) {
            if (response.status == 700) {
                setTimeout(function () {
                    cerrarSesion();
                }, 1000);
            }
            if (response.status == 200) {
                $("#btn_delete_avatar").show();
                var img = response.img;
                var imgElement = document.querySelector(id);
                var imgR = imgRoute + "/" + img; // Ruta dinámica
                imgElement.innerHTML =
                    "<img width=" +
                    width +
                    " height=" +
                    height +
                    ' class="me-1 ' +
                    css +
                    '" src="' +
                    imgR +
                    '" alt="">';
            }
            if (response.status == 300) {
                $("#btn_delete_avatar").hide();
                var img = response.img;
                var imgElement = document.querySelector(id);
                imgElement.innerHTML =
                    "<img width=" +
                    width +
                    " height=" +
                    height +
                    ' class="me-1 ' +
                    css +
                    '" src="' +
                    imgRoute +
                    '/perfil.png " alt="">';
            }
        },
        error: function () {
            error_ajax();
        },
    });
}
function Menu(numEmp) {
    $.ajax({
        url: getMenuSubmenuRoute,
        dataType: "json",
        method: "POST",
        data: {
            numEmp: numEmp,
        },
        success: function (response) {
            if (response.status == 700) {
                alerta("danger", "Sesión Finalizada");
                cerrarSesion();
            }
            if (response.status == 200) {
                //console.log(response);
                // Limpia el contenedor antes de agregar nuevos elementos
                $("#menu-container").empty();
                // Objeto para almacenar menús y sus submenús
                var menuSubmenuMap = {};
                // Recorre los datos y agrupa menús y submenús
                $.each(response.datos, function (index, item) {
                    if (item.menu) {
                        var menuId = item.menu.ID_MENU;
                        if (!menuSubmenuMap[menuId]) {
                            // Crea un objeto de menú si aún no existe
                            menuSubmenuMap[menuId] = {
                                menu: item.menu,
                                submenus: [],
                            };
                        }
                        // Agrega el submenú al menú correspondiente
                        menuSubmenuMap[menuId].submenus.push(item.submenu);
                    }
                });
                //console.log(menuSubmenuMap);
                // Crea los menús y submenús en función de los datos agrupados
                $.each(menuSubmenuMap, function (menuId, menuSubmenus) {
                    var menuHtml = '<li class="nav-item">';
                    menuHtml += '<a href="#" class="nav-link">';
                    menuHtml +=
                        '<i class="bi ' +
                        menuSubmenus.menu.ICON_MENU +
                        ' h5 me-2"></i>';
                    menuHtml += "<p>";
                    menuHtml += menuSubmenus.menu.NAME_MENU;
                    menuHtml += '<i class="right fas fa-angle-left"></i>';
                    menuHtml += "</p>";
                    menuHtml += "</a>";

                    if (menuSubmenus.submenus.length > 0) {
                        menuHtml +=
                            '<ul class="nav nav-treeview" style="font-size: 14px">';
                        $.each(
                            menuSubmenus.submenus,
                            function (index, submenu) {
                                // Convierte el texto a minúsculas y reemplaza espacios con guiones bajos
                                var formattedName =
                                    submenu.NAME_SUBMENU.toLowerCase().replace(
                                        / /g,
                                        "_"
                                    );
                                // Elimina acentos y diacríticos
                                formattedName = formattedName
                                    .normalize("NFD")
                                    .replace(/[\u0300-\u036f]/g, "");
                                var submenuURL =
                                    "http://localhost/laravel_v1/" +
                                    formattedName +
                                    "/" +
                                    appData.token;

                                menuHtml += '<li class="nav-item ms-3">';
                                menuHtml +=
                                    '<a href="' +
                                    submenuURL +
                                    "?email=" +
                                    appData.email +
                                    "&token=" +
                                    appData.token +
                                    "&numEmp=" +
                                    appData.numEmp +
                                    '" class="nav-link">';
                                menuHtml +=
                                    '<i class="bi ' +
                                    submenu.ICON_SUB +
                                    ' me-2"></i>';
                                menuHtml +=
                                    "<p>" + submenu.NAME_SUBMENU + "</p>";
                                menuHtml += "</a>";
                                menuHtml += "</li>";
                            }
                        );
                        menuHtml += "</ul>";
                    }

                    menuHtml += "</li>";
                    $("#menu-container").append(menuHtml);
                });
            }
            if (response.status == 600) {
                console.log(response);
            }
            if (response.status == 404) {
                alerta("danger", response.msj);
            }
        },
        error: function () {
            error_ajax();
        },
    });
}
function informacion_personal(numEmp) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: informacionPersonalRoute,
            dataType: "json",
            method: "POST",
            data: {
                numEmp: numEmp,
            },
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                    reject("Sesión cerrada");
                }
                if (response.status == 200) {
                    console.log(response);
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function get_mandos() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getMandosRoute,
            dataType: "json",
            method: "POST",
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                    reject("Sesión cerrada");
                }
                if (response.status == 200) {
                    //console.log(response);
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
}
function obtenerTotalEmpleado() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getTotalEmpleadosRoute,
            dataType: "json",
            method: "POST",
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                }
                if (response.status == 200) {
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function get_imagenes() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getImgRoute,
            dataType: "json",
            method: "POST",
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                }
                if (response.status == 200) {
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function conocer_tipo_usuarios(numEmp) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: conocertipousuariosRoute,
            dataType: "json",
            method: "POST",
            data: {
                numEmp: numEmp,
            },
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                    reject("Sesión cerrada");
                }
                if (response.status == 200) {
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
//choseen
function cargarEmpleados() {
    var cargando ='<h4 class="text-center text-secondary">Cargando...</h4>';
    $("#Cargando").append(cargando);
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getAllEmpleadosRoute,
            dataType: "json",
            method: "POST",
            success: function (response) {
                if (response.status == 700) {
                    setTimeout(cerrarSesion, 1000);
                    reject("Sesión cerrada");
                }
                if (response.status == 200) {
                    $("#Cargando").hide();
                    resolve(response);
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
}
