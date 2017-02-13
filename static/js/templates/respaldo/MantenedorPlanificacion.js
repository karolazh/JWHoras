var MantenedorPlanificacion = {

	guardarNuevoEvento: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error     = false;
        var msg_error = '';


        var region            = form.region.value;
        var provincias        = form.provincias.value;
        var oficina           = form.oficina.value;
        var tipo_actividad    = form.tipo_actividad.value;
        var actividad         = form.actividad.value;
        var invitacion        = form.invitacion.value;

        var fecha_inicio      = form.fecha_inicio.value;
        var hora_inicio       = form.hora_inicio.value;

        var fecha_termino     = form.fecha_termino.value;
        var hora_termino      = form.hora_termino.value;


        if (region == 0){
            msg_error += '- Debe seleccionar region<br/>';
            error = true;
        }

        if (provincias == 0){
            msg_error += '- Debe seleccionar provincia<br/>';
            error = true;
        }

		if (actividad == ""){
            msg_error += '- Debe ingresar actividad<br/>';
            error = true;
        }	

        if (tipo_actividad == 0){
            msg_error += '- Debe seleccionar Tipo actividad<br/>';
            error = true;
        }

        if (invitacion == ''){
            msg_error += '- Debe ingresar invitacion<br/>';
            error = true;
        } 

        if (fecha_inicio == ''){
            msg_error += '- Debe ingresar fecha de inicio<br/>';
            error = true;
        }

        if (fecha_termino == ''){
            msg_error += '- Debe ingresar fecha de termino<br/>';
            error = true;
        } 

        if (hora_inicio == ''){
            msg_error += '- Debe ingresar hora de inicio<br/>';
            error = true;
        }

        if (hora_termino == ''){
            msg_error += '- Debe ingresar hora de termino<br/>';
            error = true;
        } 

        if(fecha_inicio > fecha_termino){
        	msg_error += '- Fecha de inicio no puede ser mayor a fecha de termino<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        }else{
            var formulario = $(form).serialize();
            $.post(BASE_URI + 'index.php/MantenedorPlanificacion/guardarNuevoEvento', {data: formulario}, function (response) {
				//alert(response);
                if(response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorPlanificacion/index';
                    });
                }else {
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });
                }
            },'json').fail(function () {
                xModal.success("Actividad ingresada",function(){
					location.href = BASE_URI + 'index.php/MantenedorPlanificacion/index';
                   // btn.disabled = false;
                });
            });
        }
    }
}