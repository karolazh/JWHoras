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
            url: BASE_URI + "index.php/Login/ajax_guardar_nuevo_password", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    $("#password").val("");
                    $("#password_repetido").val("");
                    //$("#form-ok").removeClass("hidden");
                    //location.href = BASE_URI + "index.php/Home/dashboard";
                    limpiaErrores(data.error);
                    $("#form-error").addClass("hidden");
                    xModal.info('Contraseña Actualizada').freeze();
                    location.href = BASE_URI + "index.php/Login/actualizar";
                } else {
                    procesaErrores(data.error);
                    $("#form-error").removeClass("hidden");
                }
            }
        }); 
    });
});