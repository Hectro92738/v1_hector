$(document).ready(function () {
    // Obtén los elementos de iconos y mensajes de ayuda ??
    const helpIcon = document.getElementById("help-icon");
    const helpMessage = document.getElementById("help-message");
    const helpIconPass = document.getElementById("help-iconPass");
    const helpMessagePass = document.getElementById("help-messagePass");
    // Llama a la función para configurar los iconos y mensajes
    manejarAyuda(helpIcon, helpMessage);
    manejarAyuda(helpIconPass, helpMessagePass);
    //-------------------------------------------------------------------------------
    // Selecciona el elemento checkbox y el campo de contraseña
    var $showPasswordCheckbox = $('#show-password');
    var $passwordInput = $('#modal-password');
    // Agrega un evento change al checkbox
    $showPasswordCheckbox.change(function () {
        // Si el checkbox está seleccionado, cambia el tipo del campo de contraseña a "text"
        if ($(this).is(':checked')) {
            $passwordInput.attr('type', 'text');
        } else {
            // Si el checkbox no está seleccionado, vuelve a cambiar el tipo a "password"
            $passwordInput.attr('type', 'password');
        }
    });
    //--------------------------------------------------------------------------------------------------
    var formatoCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    $(document).on("submit", "#form_login", function (e) {
        e.preventDefault();
        borra_mensajes();
        if ($("#modal-email").val() == "") {
            error_formulario("modal-email", "El campo no puede ir vacío");
            return false;
        } else
            if ($("#modal-password").val() == "") {
                error_formulario("modal-password", "El campo no puede ir vacío");
                return false;
            } else
                if (!formatoCorreo.test($("#modal-email").val())) {
                    error_formulario("modal-email", "Formato Incorrecto de Email");
                    return false;
                }
        $.ajax({
            url: loginRoute,
            method: 'POST',
            data: {
                email: $('#modal-email').val(),
                password: $('#modal-password').val(),
                _token: $('input[name="_token"]').val()
            },
            success: function (response) {
                console.log(response);
                if (response.success == true) {
                    // Genera un token aleatorio (puedes utilizar una librería de generación de tokens más segura)
                    const token = Math.random().toString(36).substring(2);
                    const email = response.email;
                    const changePassword = response.changePassword;
                    // Almacena el token y el correo electrónico en una cookie
                    document.cookie = `session_token=${token}; path=/; SameSite=None; Secure; max-age=1200;`;
                    document.cookie = `user_email=${email}; path=/; SameSite=None; Secure; max-age=1200;`;
                    // Redirige al usuario a la página de inicio
                    appData.token = token;
                    appData.email = email;
                    appData.changePassword = changePassword;
                    // Muestra un mensaje de error
                    alerta("success", "Bienvenido");
                    if (response.changePassword == false) {
                        setTimeout(function () {
                            window.location.href = `${CrudRoute}/${token}?email=${email}&token=${token}&changePassword=${appData.changePassword}`;
                        }, 2000);
                    }
                    if (response.changePassword == true) {
                        setTimeout(function () {
                            window.location.href = `${login_cambio_PaswordRoute}/${token}?email=${email}&token=${token}&changePassword=${appData.changePassword}`;
                        }, 2000);
                    }
                }
                else {
                    alerta("danger", response.msj);
                }
            },
            error: function () {
                error_ajax();
            },
        });
    });
});


