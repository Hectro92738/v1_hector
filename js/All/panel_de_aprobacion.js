$(document).ready(function () {
    conocer_tipo_usuarios(appData.numEmp)
        .then(function (response) {
            //console.log(response);
            var ubi = response.ubicacion; // Departaento y Direccion de cada mando
            var job = response.jobName;
            var departamento = ubi.DEPT; // Departamento de cada mando
            var organizacion = ubi.ORGANIZACION; // ORGANIZACION de cada mando
            switch (response.jobName) {
                case "A05":
                    //----------------------------------------------------------------
                    //----------------------Uso una Promesa --------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            //console.log(response);
                            var empleados = response.empleados;
                            empleados = empleados.filter(function (empleado) {
                                return empleado.EMP_NUM != appData.numEmp;
                            });
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            if (
                                                row.JobNamePrefix === "B05" ||
                                                row.JobNamePrefix === "E10" ||
                                                (row.JobNamePrefix === "C10" &&
                                                    (row.DIRE === "PC60" ||
                                                        row.DIRE === "PC50"))
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });

                            // Agrega un manejador de eventos al botón en la tabla
                            $("#empleadosTable tbody").on(
                                "click",
                                "button",
                                function () {
                                    var data = dataTable
                                        .row($(this).parents("tr"))
                                        .data();

                                    // Muestra la modal
                                    $("#modal_empleado").modal("show");

                                    var modalBody = $(
                                        "#modal_empleado .modal-body"
                                    );
                                    modalBody.html("");
                                    modalBody.append(
                                        "<p><strong>Empleado Número:</strong> " +
                                            data.EMP_NUM +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>Nombre del Empleado:</strong> " +
                                            data.EMP_NAME +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>RFC:</strong> " +
                                            data.EMP_RFC +
                                            "</p>"
                                    );
                                }
                            );
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });

                    //----------------------------------------------------------------
                    break;
                case "B05":
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            //console.log(response);
                            var empleados = response.empleados;
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            if (ubi.DIRE === "PC90") {
                                var empleadosFiltrados = empleados.filter(
                                    function (empleado) {
                                        return (
                                            (empleado.DIRE === "PC90" ||
                                                empleado.DIRE === "PD00") &&
                                            empleado.EMP_NUM != appData.numEmp
                                        );
                                    }
                                );
                            }
                            if (ubi.DIRE === "PC70") {
                                var empleadosFiltrados = empleados.filter(
                                    function (empleado) {
                                        return (
                                            empleado.DIRE === "PC70" &&
                                            empleado.EMP_NUM != appData.numEmp
                                        );
                                    }
                                );
                            }
                            if (ubi.DIRE === "PC80") {
                                var empleadosFiltrados = empleados.filter(
                                    function (empleado) {
                                        return (
                                            empleado.DIRE === "PC80" &&
                                            empleado.EMP_NUM != appData.numEmp
                                        );
                                    }
                                );
                            }
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            var jobNamePrefix =
                                                row.JobNamePrefix;

                                            if (
                                                jobNamePrefix === "C05" ||
                                                jobNamePrefix === "C10" ||
                                                jobNamePrefix === "D05"
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });

                            // Agrega un manejador de eventos al botón en la tabla
                            $("#empleadosTable tbody").on(
                                "click",
                                "button",
                                function () {
                                    var data = dataTable
                                        .row($(this).parents("tr"))
                                        .data();

                                    // Muestra la modal
                                    $("#modal_empleado").modal("show");

                                    var modalBody = $(
                                        "#modal_empleado .modal-body"
                                    );
                                    modalBody.html("");
                                    modalBody.append(
                                        "<p><strong>Empleado Número:</strong> " +
                                            data.EMP_NUM +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>Nombre del Empleado:</strong> " +
                                            data.EMP_NAME +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>RFC:</strong> " +
                                            data.EMP_RFC +
                                            "</p>"
                                    );
                                }
                            );
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                case "C05":
                    //alerta("success", "C05");
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            var empleados = response.empleados;
                            console.log(departamento);
                            var empleadosFiltrados = empleados.filter(function (
                                empleado
                            ) {
                                return (
                                    empleado.DEPT === departamento &&
                                    empleado.EMP_NUM != appData.numEmp
                                );
                            });
                            //----------------------------------------------------------------
                            // Verificar si hay al menos un empleado con jobNamePrefix "E05" o "E10"
                            var tieneE05oE10 = empleadosFiltrados.some(
                                function (empleado) {
                                    return (
                                        empleado.JobNamePrefix === "E05" ||
                                        empleado.JobNamePrefix === "E10"
                                    );
                                }
                            );
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            // Verificar si el empleado tiene la misma organización
                                            if (
                                                row.ORGANIZACION ===
                                                organizacion
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else if (
                                                tieneE05oE10 &&
                                                (row.JobNamePrefix === "E05" ||
                                                    row.JobNamePrefix === "E10")
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });

                            // Agrega un manejador de eventos al botón en la tabla
                            $("#empleadosTable tbody").on(
                                "click",
                                "button",
                                function () {
                                    var data = dataTable
                                        .row($(this).parents("tr"))
                                        .data();

                                    // Muestra la modal
                                    $("#modal_empleado").modal("show");

                                    var modalBody = $(
                                        "#modal_empleado .modal-body"
                                    );
                                    modalBody.html("");
                                    modalBody.append(
                                        "<p><strong>Empleado Número:</strong> " +
                                            data.EMP_NUM +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>Nombre del Empleado:</strong> " +
                                            data.EMP_NAME +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>RFC:</strong> " +
                                            data.EMP_RFC +
                                            "</p>"
                                    );
                                }
                            );
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                case "C10":
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            var empleados = response.empleados;
                            console.log(response);
                            var empleadosFiltrados = empleados.filter(function (
                                empleado
                            ) {
                                return (
                                    empleado.DEPT === departamento &&
                                    empleado.EMP_NUM != appData.numEmp
                                );
                            });
                            //-------------------------------------------------------------
                            // Verificar si hay al menos un empleado con jobNamePrefix "E05"
                            var tieneE05oE10 = empleadosFiltrados.some(
                                function (empleado) {
                                    return (
                                        empleado.JobNamePrefix === "E05" ||
                                        empleado.JobNamePrefix === "E10"
                                    );
                                }
                            );
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            // Verificar si el empleado tiene la misma organización
                                            if (
                                                row.ORGANIZACION ===
                                                organizacion
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else if (
                                                tieneE05oE10 &&
                                                (row.JobNamePrefix === "E05" ||
                                                    row.JobNamePrefix === "E10")
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });

                            // Agrega un manejador de eventos al botón en la tabla
                            $("#empleadosTable tbody").on(
                                "click",
                                "button",
                                function () {
                                    var data = dataTable
                                        .row($(this).parents("tr"))
                                        .data();

                                    // Muestra la modal
                                    $("#modal_empleado").modal("show");

                                    var modalBody = $(
                                        "#modal_empleado .modal-body"
                                    );
                                    modalBody.html("");
                                    modalBody.append(
                                        "<p><strong>Empleado Número:</strong> " +
                                            data.EMP_NUM +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>Nombre del Empleado:</strong> " +
                                            data.EMP_NAME +
                                            "</p>"
                                    );
                                    modalBody.append(
                                        "<p><strong>RFC:</strong> " +
                                            data.EMP_RFC +
                                            "</p>"
                                    );
                                }
                            );
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                case "D05":
                    //console.log(organizacion);
                    get_aprobacion(appData.numEmp, function (response) {
                        console.log(response);
                        var data = response
                    });
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            var empleados = response.empleados;

                            //----------------------------------------------------------------
                            var empleadosFiltrados = empleados.filter(function (
                                empleado
                            ) {
                                return (
                                    empleado.DEPT === departamento &&
                                    empleado.EMP_NUM != appData.numEmp
                                );
                            });
                            //console.log(empleados);
                            //----------------------------------------------------------------
                            // Verificar si hay al menos un empleado con jobNamePrefix "E05" o "E10"
                            var tieneE05oE10 = empleadosFiltrados.some(
                                function (empleado) {
                                    return (
                                        empleado.JobNamePrefix === "E05" ||
                                        empleado.JobNamePrefix === "E10"
                                    );
                                }
                            );
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            // Verificar si el empleado tiene la misma organización
                                            if (
                                                row.ORGANIZACION ===
                                                organizacion
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else if (
                                                tieneE05oE10 &&
                                                (row.JobNamePrefix === "E05" ||
                                                    row.JobNamePrefix === "E10")
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                case "E05":
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            var empleados = response.empleados;
                            if (appData.numEmp == "84977") {
                                alerta("success", "SI");
                                var empleadosFiltrados = empleados.filter(
                                    function (empleado) {
                                        return (
                                            empleado.EMP_NUM == "124737" &&
                                            empleado.EMP_NUM == "85293" &&
                                            empleado.EMP_NUM == "125637" &&
                                            empleado.EMP_NUM != appData.numEmp
                                        );
                                    }
                                );
                            } else {
                                var empleadosFiltrados = empleados.filter(
                                    function (empleado) {
                                        return (
                                            empleado.ORGANIZACION ==
                                                organizacion &&
                                            empleado.EMP_NUM != appData.numEmp
                                        );
                                    }
                                );
                            }
                            console.log(empleadosFiltrados);
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            if (
                                                row.ORGANIZACION == organizacion
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                case "C15":
                    //----------------------------------------------------------------
                    cargarEmpleados()
                        .then(function (response) {
                            var empleados = response.empleados;
                            console.log(organizacion);
                            var empleadosFiltrados = empleados.filter(function (
                                empleado
                            ) {
                                return (
                                    empleado.ORGANIZACION === organizacion &&
                                    empleado.EMP_NUM != appData.numEmp
                                );
                            });
                            //-------------------------------------------------------------
                            // Verificar si hay al menos un empleado con jobNamePrefix "E05" o "E10"
                            var tieneE05oE10 = empleadosFiltrados.some(
                                function (empleado) {
                                    return empleado.JobNamePrefix === "E05";
                                }
                            );
                            //------ Verificamos a que DIRECCION pertenes cada mando--------
                            //--------------------------------------------------------------
                            var dataTable = $("#empleadosTable").DataTable({
                                paging: true,
                                scrollCollapse: true,
                                autoFill: true,
                                responsive: true,
                                scrollX: true,
                                scrollY: "70vh",
                                data: empleadosFiltrados,
                                columns: [
                                    {
                                        data: null,
                                        render: function (data, type, row) {
                                            // Verificar si el empleado tiene la misma organización
                                            if (
                                                row.ORGANIZACION ===
                                                organizacion
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else if (
                                                tieneE05oE10 &&
                                                row.JobNamePrefix === "E05"
                                            ) {
                                                return '<button class="btn_Empleado"><i class="bi bi-plus-lg"></i></button>';
                                            } else {
                                                return "";
                                            }
                                        },
                                    },
                                    { data: "EMP_NUM" },
                                    { data: "EMP_NAME" },
                                    { data: "EMP_RFC" },
                                    { data: "EMP_IMSS" },
                                    { data: "EMP_BIRTHDATE" },
                                    { data: "ORGANIZACION" },
                                    { data: "DIRE" },
                                    { data: "TIPO_CONTRATO" },
                                    { data: "ESTATUS" },
                                ],
                                order: [
                                    [0, "desc"], // Ordena por la primera columna (el botón) de forma descendente
                                ],
                            });
                        })
                        .catch(function () {
                            // Manejar errores de la promesa
                            console.log("Error al obtener los empleados.");
                        });
                    //----------------------------------------------------------------
                    break;
                default:
                    alerta("info", "NO PERTENECE A UN MANDO");
            }
        })
        .catch(function () {
            // Manejar errores de la promesa
            console.log("Error al obtener las imágenes:");
        });
});
function get_aprobacion(numEmp) {
    $.ajax({
        url: getaprobacionRoute,
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
                console.log(response);
            }
        },
        error: function () {
            error_ajax();
        },
    });
}
