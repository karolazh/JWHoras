var Proyectos = {

    guardarNuevoProyecto: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.nombre_proyecto.value == "") {
            msg_error += '- Debe ingresar nombre del proyecto<br/>';
            error = true;
        }

        if (form.descripcion.value == "") {
            msg_error += '- Debe ingresar descripción del proyecto<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });

        } else {
            var formulario = $(form).serialize();
            //alert(formulario);
            $.post(BASE_URI + 'index.php/Proyecto/guardarNuevoProyecto', {data: formulario}, function (response) {
                //alert(response);
                if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/Proyecto';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });

            });
        }

    }
}