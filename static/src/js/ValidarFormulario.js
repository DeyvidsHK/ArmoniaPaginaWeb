$(document).ready(function () {
    $('#form-contactanos').submit(function (e) {
        e.preventDefault();
        var nombre = $("#nombre").val();
        var telefono = $("#telefono").val();
        var correo = $("#correo").val();
        var mensaje = $("#mensaje").val();

        if (nombre === "" || telefono === "" || correo === "" || mensaje === "") {
            alert("Por favor, completa todos los campos del formulario.");
        } else {
            grecaptcha.ready(function () {
                grecaptcha.execute('6Lcfa9UoAAAAADi4UP9HSl-0kPaTUUBk7lLzYHAQ', {
                    action: 'validarUsuario'
                }).then(function (token) {
                    $.ajax({
                        type: "POST",
                        url: "validar.php",
                        data: {
                            token: token,
                            action: "validarUsuario"
                        },
                        success: function (data) {
                            if (data === "OK") {
                                // Si el reCAPTCHA es válido, enviar el formulario
                                $("#form-contactanos").unbind('submit').submit();
                            } else {
                                alert("Error en la verificación reCAPTCHA.");
                                e.preventDefault();
                            }
                        },
                        error: function () {
                            alert("Error en la verificación reCAPTCHA.");
                            e.preventDefault();
                        }
                    });
                });
            });
        }
    });
});
