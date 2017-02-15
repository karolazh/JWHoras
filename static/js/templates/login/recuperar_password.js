$(document).ready(function() {
    $("#enviar").on('click', function(e) {
        var button_process = buttonStartProcess($(this), e);
        var parametros = $("#form").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Login/recuperar_password_rut", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    $("#form-contenedor").addClass("hidden");
                    $("#form-success").removeClass("hidden");
                    $("#mensaje-modificacion").html("Se han enviado los datos para recuperar contraseña al correo asociado a su rut</strong>");
                } else {
                    procesaErrores(data.error);
                    $("#form-error").removeClass("hidden");
                }
            }
        }); 
    }); 
});
