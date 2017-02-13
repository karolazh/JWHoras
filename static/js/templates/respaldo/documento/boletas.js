 var Boletas={
    guardarDetalle:function  (form, btn) {
        /*
         realizar validacion formulario
         */
       
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.codigo.value == 0) {
            msg_error += '- Debe ingresar código del producto<br/>';
            error = true;
        }
        if (form.glosa.value == 0) {
            msg_error += '- Debe ingresar la glosa<br/>';
            error = true;
        }
        if (form.cantidad.value == "") {
            msg_error += '- Debe ingresar la cantidad<br/>';
            error = true;
        }
        if (form.precio.value == "") {
            msg_error += '- Debe ingresar el precio\n';
            error = true;
        }
        alert("hasta aqui modal")
        //return 0
        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
            alert("2")
        } else {
            
            //return 0
            var formulario = $(form).serialize();
            //alert(BASE_URI);
            $.post(BASE_URI + 'index.php/Documento/guardarDetalle', {data: formulario}, function (response) {
                form.guardarBoleta.disabled=false
                document.getElementById("divDetalle").style.display = "block";
                xModal.success("Detalle guardado correctamente",function(){
                    btn.disabled = false;
                });
                /*form.rut_emisor_boleta.disabled=true
                form.subsecretaria_boleta.disabled=true
                form.tipo_boleta.disabled=true
                form.numero_boleta.disabled=true*/

                /*if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        //location.href = BASE_URI + 'index.php/Documento/boletas';
                    });

                } else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });

                }*/
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                   //alert("hasta aca")
                });

            });
        }
    }
}