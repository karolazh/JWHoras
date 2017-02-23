$(document).ready(function() {
    $("#guardar").on('click', function(e) {
        var button_process = buttonStartProcess($(this), e);
        var parametros = $("#form").serialize();
        $.ajax({         
            dataType: "json",
            cache:false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Usuario/peticion_modificar_password_email", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    $("#form-contenedor").addClass("hidden");
                    $("#form-success").removeClass("hidden");
                    $("#mensaje-email-enviado").html("Se ha enviado un email a la dirección <strong>" + data.email + "</strong> con las indicaciones a seguir para modificar la contraseña")
                } else {
                    procesaErrores(data.error);
                    $("#form-error").removeClass("hidden");
                }
            }
        }); 
    }); 
});
    


