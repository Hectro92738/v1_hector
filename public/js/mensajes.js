function error_formulario(campo, mensaje) {
	$("#group-" + campo).append($("<div>", {
		"class": "invalid-feedback",
		"text": mensaje
	}));
	$("#" + campo)
		.addClass("is-invalid")
		.focus();
}
function borra_mensajes() {
	$(".is-invalid").removeClass("is-invalid");
	$(".invalid-feedback").remove();
}
function error_ajax() {
	alerta("danger", "System Error");
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
		case "warning":
			icono = "bi bi-exclamation-triangle";
			break;
		case "danger":
			icono = "bi bi-exclamation-circle";
			claseAlerta = "custom-danger";
			break;
	}
	$("#mensaje").append('<div class="alert ' +
		claseAlerta +
		' alert-dismissible fade show" role="alert"><i class="' +
		icono +
		' h4"></i> ' +
		mensaje + '</div>');

	setTimeout(function () {
		$(".alert-dismissible").fadeOut(1000, function () {
			$(this).remove();
		});
	}, 2000);
}
function actualizar() {
	location.reload(true);
}
function fecha_fancy(sFecha) {
	const ames = ["ene", "feb", "mar", "abr",
		"may", "jun", "jul", "ago",
		"sep", "oct", "nov", "dic"];

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
		method: 'POST',
		success: function () {
			document.cookie = 'session_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
			document.cookie = 'user_email=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
			delete appData.email;
			delete appData.token;
			alerta("danger", "Sesión Finalizada");
			setTimeout(function () {
				window.location.href = `${indexRoute}`;
			}, 2000);
		},
		error: function () {
			alert('Ha ocurrido un error al cerrar la sesión.');
		},
	});
}
function HoraActual() {
	var today = new Date();
	var hh = String(today.getHours()).padStart(2, '0');
	var min = String(today.getMinutes()).padStart(2, '0');
	var ss = String(today.getSeconds()).padStart(2, '0');
	var HoraActual = hh + ':' + min + ':' + ss;
	return HoraActual;
}
function fechaActual() {
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0');
	var yyyy = today.getFullYear();
	var fechaActual = dd + '-' + mm + '-' + yyyy;
	return fechaActual;
};