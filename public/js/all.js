$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	// Llama a la función cerrarSesion cada 15 minutos
	setInterval(cerrarSesion, 900000);
	$('#salir').click(function () {
		cerrarSesion();
	});
});
