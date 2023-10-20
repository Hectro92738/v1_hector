$(document).ready(function () {
    menu_iconos();
    var iconoSeleccionado = false;
    get_menu()
        .then(function (response) {
            var menus = response.menus;
            if (menus.length > 0) {
                var table = '<table class="table">';
                table += "<thead>";
                table += "<tr>";
                table += "<th>Nombre</th>";
                table += "<th>Icono</th>";
                table += "<th>Acción</th>";
                table += "</tr>";
                table += "</thead>";
                table += "<tbody>";
                menus.forEach(function (menu) {
                    table +=
                        '<tr class="' +
                        (menu.ESTATUS == "I" ? "estatus-inactivo" : "") +
                        '">';
                    table += "<td>" + menu.NAME_MENU + "</td>";
                    table +=
                        '<td style="position: relative;"><i class="bi ' +
                        menu.ICON_MENU +
                        ' h4 "></i>' +
                        "</td>";
                    table +=
                        '<td style="position: relative;">' +
                        '<i class="bi bi-list menu_btn btn btn-info"></i>' +
                        //-------------------------------------------------------------------------------------
                        '<div class="icons_menu" style="position: absolute; top: -10px; background-color: white; border: 1px solid #ccc; padding: 5px; display: none; width: 180px; left: 30%; transform: translateX(-50%);">' +
                        "<p>" +
                        '<button onclick="click_btn_borrar_menu(' +
                        menu.ID_MENU +
                        ')" data-bs-toggle="modal" data-bs-target="#drop_menu" type="submit" class="btn btn-sm btn-danger me-4"><i class="bi bi-trash"></i></button>' +
                        '<button type="button" id="btn_editar_menu" class="btn btn-sm btn-success me-4" onclick="click_btn_editar_menu(' +
                        menu.ID_MENU +
                        ')"><i class="bi bi-pencil-square"></i></button>' +
                        '<button id="estatus_menu" onclick="click_btn_menu(' +
                        menu.ID_MENU +
                        ')" class="btn btn-info btn-sm">' +
                        (menu.ESTATUS == "A"
                            ? '<i class="bi bi-toggle-on"></i>'
                            : '<i class="bi bi-toggle-off"></i>') +
                        "</button>" +
                        "</p>" +
                        "</div>" +
                        //-------------------------------------------------------------------------------------
                        "</td>";
                    table += "</tr>";
                });

                table += "</tbody>";
                table += "</table>";

                $("#imfo_menu").html(table);
                botones_MENU();
            } else {
                $("#imfo_menu").html("No se encontraron menús.");
            }
        })
        .catch(function (error) {
            //alerta("info", "ERROR Promise");
            console.log("eeror en la promesa");
        });
    //------------------------------------------------------------------------------------
    get_submenu()
        .then(function (response) {
            var submenus = response.submenus;
            if (submenus.length > 0) {
                var table = '<table class="table">';
                table += "<thead>";
                table += "<tr>";
                table += "<th>Nombre</th>";
                table += "<th>Icono</th>";
                table += "<th>Estatus</th>";
                table += "</tr>";
                table += "</thead>";
                table += "<tbody>";
                submenus.forEach(function (menu) {
                    table +=
                        '<tr class="' +
                        (menu.ESTATUS == "I" ? "estatus-inactivo" : "") +
                        '">';
                    table += "<td>" + menu.NAME_SUBMENU + "</td>";
                    table +=
                        '<td><i class="bi ' + menu.ICON_SUB + ' h4"></i></td>';
                    table +=
                        '<td style="position: relative;">' +
                        '<i class="bi bi-list submenu_btn btn btn-info"></i>' +
                        //-------------------------------------------------------------------------------------
                        '<div class="icons_submenu" style="position: absolute; top: -20px; background-color: white; border: 1px solid #ccc; padding: 5px; display: none; width: 180px; left: 30%; transform: translateX(-50%);">' +
                        "<p>" +
                        '<button onclick="click_btn_borrar_submenu(' +
                        menu.ID_SUBMENU +
                        ')" data-bs-toggle="modal" data-bs-target="#drop_submenu" type="submit" class="btn btn-sm btn-danger me-4"><i class="bi bi-trash"></i></button>' +
                        '<button type="button" id="btn_editar_submenu" class="btn btn-sm btn-success me-4" onclick="click_btn_editar_submenu(' +
                        menu.ID_SUBMENU +
                        ')"><i class="bi bi-pencil-square"></i></button>' +
                        '<button id="estatus_submenu" onclick="click_btn_submenu(' +
                        menu.ID_SUBMENU +
                        ')" class="btn btn-info btn-sm">' +
                        (menu.ESTATUS == "A"
                            ? '<i class="bi bi-toggle-on"></i>'
                            : '<i class="bi bi-toggle-off"></i>') +
                        "</button>" +
                        "</p>" +
                        "</div>" +
                        //-------------------------------------------------------------------------------------
                        "</td>";
                    table += "</tr>";
                });
                table += "</tbody>";
                table += "</table>";
                $("#imfo_submenu").html(table);
                botones_SUBMENU();
            } else {
                $("#imfo_submenu").html("No se encontraron menús.");
            }
        })
        .catch(function (error) {
            //alerta("info", "ERROR Promise");
            console.log("eeror en la promesa");
        });
    //------------------------ CAMBIE DE ESTATUS MENU ----------------------------
    $(document).on("click", "#estatus_menu", function () {
        $.ajax({
            url: ubdateEstatusMenuRoute,
            dataType: "json",
            method: "POST",
            data: {
                id: appData.id_menu,
            },
            success: function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                }
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //----------------------- CAMBIE DE ESTATUS SUBMENU --------------------------
    $(document).on("click", "#estatus_submenu", function () {
        $.ajax({
            url: ubdateEstatusSubmenuRoute,
            dataType: "json",
            method: "POST",
            data: {
                id: appData.id_submenu,
            },
            success: function (response) {
                if (response.status == 700) {
                    cerrarSesion();
                }
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //-------------------------- FORZA A ELEJIR UN ICONO ------------------------
    $(document).on("change", 'input[name="modal-icono"]', function () {
        if ($(this).is(":checked")) {
            iconoSeleccionado = true;
        }
    });
    //---------------------CREAR NUEVO MENU-----------------------------------
    $(document).on("submit", "#form_crea_menu", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-nombre").val() == "") {
            error_formulario("modal-nombre", "El campo no puede ir vacío");
            return false;
        }
        if (!iconoSeleccionado) {
            alerta("info", "Seleccione un icono");
            return false;
        }
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: insertMenuRoute,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
                if (response.status == 400) {
                    alerta("info", response.msj);
                }
                if (response.status == 700) {
                    cerrarSesion();
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //---------------------CREAR NUEVO SUBMENU--------------------------------
    $(document).on("submit", "#form_crea_submenu", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-nombre-sub").val() == "") {
            error_formulario("modal-nombre-sub", "El campo no puede ir vacío");
            return false;
        }
        if (!iconoSeleccionado) {
            alerta("info", "Seleccione un icono");
            return false;
        }
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: insertSubMenuRoute,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
                if (response.status == 400) {
                    alerta("info", response.msj);
                }
                if (response.status == 700) {
                    cerrarSesion();
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //----------------------ELIMINAR - MENU-----------------------------------
    $("#eliminar_menu").click(function () {
        $.ajax({
            url: EliminarMenuRoute,
            dataType: "json",
            type: "POST",
            data: {
                id: appData.id_drop_menu,
            },
        })
            .done(function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                } else if (response.status == 200) {
                    alerta("success", response.msj);
                    setTimeout(function () {
                        setInterval(actualizar, 1000);
                    }, 1000);
                } else if (response.status == 404) {
                    alerta("danger", response.msj);
                } else if (response.status == 500) {
                    alerta("info", response.msj);
                }
            })
            .fail(error_ajax);
    });
    //----------------------ELIMINAR - SUBMENU---------------------------------
    $("#eliminar_submenu").click(function () {
        $.ajax({
            url: EliminarSubMenuRoute,
            dataType: "json",
            type: "POST",
            data: {
                id: appData.id_drop_submenu,
            },
        })
            .done(function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                } else if (response.status == 200) {
                    alerta("success", response.msj);
                    setTimeout(function () {
                        setInterval(actualizar, 1000);
                    }, 1000);
                } else if (response.status == 404) {
                    alerta("danger", response.msj);
                } else if (response.status == 500) {
                    alerta("info", response.msj);
                }
            })
            .fail(error_ajax);
    });
    //---------------------MOSTRAR MENU PAR EDITAR -----------------------------
    $(document).on("click", "#btn_editar_menu", function (e) {
        var modal = $("#editar_menu");
        modal.modal("show");
        e.preventDefault();
        $("#input_nomb_menu").empty(); 
        $("#nombre_menu").empty(); 
        $.ajax({
            url: getMenuEditarRoute,
            dataType: "json",
            type: "POST",
            data: {
                id: appData.editar_menu,
            },
        })
            .done(function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                } else if (response.status == 200) {
                    var p = response.menu;
                    var nombre =
                        'Editando a <strong class="ms-2">' +
                        p.NAME_MENU +
                        ' <i class="ms-2 bi ' +
                        p.ICON_MENU +
                        '"></strong>';
                    $("#nombre_menu").append(nombre);
                    var compraHTML =
                        '<div class="input-group" id="group-modal-nombre-edi">' +
                        '<span class="input-group-text">Nombre</span>' +
                        '<input type="text" id="modal-nombre-edi" value="' +
                        p.NAME_MENU +
                        '" name="modal-nombre-edi" class="form-control" placeholder="Nombre del Menú">' +
                        '<span class="input-group-text"><i class="bi ' +
                        p.ICON_MENU +
                        '"></i></span>' +
                        "</div>";
                    $("#input_nomb_menu").append(compraHTML);
                } else if (response.status == 404) {
                    alerta("danger", response.msj);
                }
            })
            .fail(error_ajax);
    });
    //---------------------MOSTRAR SUBMENU PAR EDITAR -----------------------------
    $(document).on("click", "#btn_editar_submenu", function (e) {
        var modal = $("#modal_editar_submenu");
        modal.modal("show");
        e.preventDefault();
        $("#input_nomb_submenu").empty(); 
        $("#nombre_submenu").empty(); 
        $.ajax({
            url: getSubMenuEditarRoute,
            dataType: "json",
            type: "POST",
            data: {
                id: appData.editar_submenu,
            },
        })
            .done(function (response) {
                if (response.status == 700) {
                    setTimeout(function () {
                        cerrarSesion();
                    }, 1000);
                } else if (response.status == 200) {
                    var p = response.menu;
                    var nombre =
                        'Editando a <strong class="ms-2">' +
                        p.NAME_SUBMENU +
                        ' <i class="ms-2 bi ' +
                        p.ICON_SUB +
                        '"></strong>';
                    $("#nombre_submenu").append(nombre);
                    var compraHTML =
                        '<div class="input-group" id="group-modal-nombre-edi-sub">' +
                        '<span class="input-group-text">Nombre</span>' +
                        '<input type="text" id="modal-nombre-edi-sub" value="' +
                        p.NAME_SUBMENU +
                        '" name="modal-nombre-edi-sub" class="form-control" placeholder="Nombre del Menú">' +
                        '<span class="input-group-text"><i class="bi ' +
                        p.ICON_SUB +
                        '"></i></span>' +
                        "</div>";
                    $("#input_nomb_submenu").append(compraHTML);
                } else if (response.status == 404) {
                    alerta("danger", response.msj);
                }
            })
            .fail(error_ajax);
    });
    //---------------------INSERT MENU EDITADO --------------------------------
    $(document).on("submit", "#form_edit_menu", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-nombre-edi").val() == "") {
            error_formulario("modal-nombre-edi", "El campo no puede ir vacío");
            return false;
        }
        var formData = new FormData($(this)[0]);
        var id = appData.editar_menu; 
        formData.append("id_menu", id); 
        $.ajax({
            url: insertMenuEditadoRoute,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
                if (response.status == 400) {
                    alerta("info", response.msj);
                }
                if (response.status == 700) {
                    cerrarSesion();
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
    //---------------------INSERT SUBMENU EDITADO --------------------------------
    $(document).on("submit", "#form_edit_submenu", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-nombre-edi-sub").val() == "") {
            error_formulario("modal-nombre-edi-sub", "El campo no puede ir vacío");
            return false;
        }
        var formData = new FormData($(this)[0]);
        var id = appData.editar_submenu; 
        formData.append("id_submenu", id);
        $.ajax({
            url: insertSubMenuEditadoRoute,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    alerta("success", response.msj);
                    setInterval(actualizar, 1000);
                }
                if (response.status == 400) {
                    alerta("info", response.msj);
                }
                if (response.status == 700) {
                    cerrarSesion();
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });

    
});

function click_btn_menu(id) {
    appData.id_menu = id;
}
function click_btn_submenu(id) {
    appData.id_submenu = id;
}
function click_btn_borrar_menu(id) {
    appData.id_drop_menu = id;
}
function click_btn_borrar_submenu(id) {
    appData.id_drop_submenu = id;
}
function click_btn_editar_menu(id) {
    appData.editar_menu = id;
}
function click_btn_editar_submenu(id) {
    appData.editar_submenu = id;
}
function get_menu() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getMenuRoute,
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
                    resolve(response);
                }
            },
            error: function () {
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function get_submenu() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: getSubmenuRoute,
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
                reject("Error en la solicitud AJAX");
            },
        });
    });
}
function botones_MENU() {
    const iconos = document.querySelectorAll(".menu_btn");
    const mensajes = document.querySelectorAll(".icons_menu");

    iconos.forEach((icono, index) => {
        icono.addEventListener("click", function () {
            if (mensajes[index].style.display === "block") {
                mensajes[index].style.display = "none";
            } else {
                mensajes[index].style.display = "block";
            }
            setTimeout(function () {
                mensajes[index].style.display = "none";
            }, 15000);
        });
    });

    document.addEventListener("click", function (event) {
        mensajes.forEach((mensaje, index) => {
            if (event.target !== mensaje && event.target !== iconos[index]) {
                mensaje.style.display = "none";
            }
        });
    });
}
function botones_SUBMENU() {
    const iconos = document.querySelectorAll(".submenu_btn");
    const mensajes = document.querySelectorAll(".icons_submenu");

    iconos.forEach((icono, index) => {
        icono.addEventListener("click", function () {
            if (mensajes[index].style.display === "block") {
                mensajes[index].style.display = "none";
            } else {
                mensajes[index].style.display = "block";
            }
            setTimeout(function () {
                mensajes[index].style.display = "none";
            }, 15000);
        });
    });

    document.addEventListener("click", function (event) {
        mensajes.forEach((mensaje, index) => {
            if (event.target !== mensaje && event.target !== iconos[index]) {
                mensaje.style.display = "none";
            }
        });
    });
}
function menu_iconos() {
    const iconosDisponibles = [
        "bi-archive",
        "bi-arrow-clockwise",
        "bi-backpack2",
        "bi-backspace",
        "bi-bag-dash",
        "bi-bar-chart-line",
        "bi-bicycle",
        "bi-box-seam",
        "bi-briefcase",
        "bi-broadcast",
        "bi-calendar-event",
        "bi-chat-dots",
        "bi-clock",
        "bi-file-earmark-break",
        "bi-file-earmark-pdf",
        "bi-folder2",
        "bi-gear",
        "bi-front",
        "bi-hdd-stack",
        "bi-images",
        "bi-journal-bookmark",
        "bi-key",
        "bi-layers-half",
        "bi-list-check",
        "bi-pencil",
        "bi-person-fill",
        "bi-person-gear",
        "bi-stack-overflow",
        "bi-table",
        "bi-tags",
        "bi-toggles2",
        "bi-book",
        "bi-file-earmark-arrow-up",
        "bi-folder-symlink",
        "bi-folder-x",
        "bi-inboxes",
        "bi-journal",
        "bi-mailbox",
        "bi-pen",
        "bi-scissors",
        "bi-search",
        "bi-tools",
        "bi-clipboard",
        "bi-credit-card",
        "bi-file-earmark-play",
        "bi-folder-symlink-fill",
        "bi-piggy-bank",
        "bi-folder2-open",
        "bi-gear",
        "bi-wrench-adjustable-circle",
        "bi-fullscreen",
        "bi-person-workspace",
        "bi-window-fullscreen",
        "bi-person-circle",
        "bi-check2-square",
        "bi-ui-checks",
        "bi-list",
        "bi-at",
        "bi-back",
        "bi-bookmarks",
        "bi-boxes",
        "bi-calendar-check",
        "bi-check-circle",
        "bi-droplet",
        "bi-envelope",
        "bi-envelope-plus",
        "bi-exclamation-circle",
        "bi-file-pdf",
        "bi-filter-left",
        "bi-filetype-doc",
        "bi-grid-1x2",
        "bi-info-lg",
        "bi-layout-text-sidebar-reverse",
        "bi-layers",
        "bi-lightbulb",
        "bi-filetype-html",
        "bi-fire",
        "bi-floppy",
        "bi-gem",
        "bi-globe-americas",
        "bi-hourglass-split",
        "bi-mortarboard",
        "bi-person-up",
        "bi-person-standing",
        "bi-qr-code-scan",
        "bi-universal-access",
        "bi-wrench",
        "bi-shuffle",
    ];

    const iconoContainers = document.querySelectorAll(".group-modal-icono");

    iconoContainers.forEach((container) => {
        const iconoHTML = iconosDisponibles
            .map(
                (clase) => `
            <label class="btn">
                <input class="form-check-input" type="radio" name="modal-icono" data-icono="${clase}" value="${clase}">
                <i class="bi ${clase}"></i>
            </label>
        `
            )
            .join("");

        container.innerHTML = iconoHTML;
    });
}
