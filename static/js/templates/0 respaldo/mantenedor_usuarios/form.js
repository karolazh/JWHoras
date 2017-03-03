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
            url: BASE_URI + "index.php/MantenedorUsuarios/guardar", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    location.href = BASE_URI + "index.php/MantenedorUsuarios/index";
                } else {
                    procesaErrores(data.error);
                    $("#form-error").removeClass("hidden");
                }
            }
        }); 
    });
});