/* global BASE_URI */

var Registro = {

    guardarNuevoAdjunto: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        
        if (form.tipoDoc.value == 0) {
            msg_error += 'Seleccione Tipo de documento<br/>';
            error = true;
        }
        
        if (form.archivo.value == "") {
            msg_error += 'Seleccione Archivo<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });

        } else {
            var formulario = $(form).serialize();
            //alert(formulario);
            //
            $.post(BASE_URI + 'index.php/Registro/guardarNuevoAdjunto', {data: formulario}, 
            function (response) {
                //alert(response);
                if (response.estado == true) {
//                    xModal.success(response.mensaje,function(){
//                        location.href = BASE_URI + 'index.php/Proyecto';
//                    });
//
                } else {
//                    xModal.danger(response.mensaje,function(){
//                        btn.disabled = false;
//                    });
//
                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });
            });
        }

    }
}