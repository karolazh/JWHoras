var MantenedorActividades = {
	
	//funcion para subir archivos
	subirArchivo: function (form){
        $(form).submit(function (){
            $.post(BASE_URI + 'index.php/MantenedorActividades/cargarGrillaAdjuntos', function (response) {
                $("#lista_adjuntos").html(response);
            }, 'html');
        });
    },
	
	//funcion para cargar grilla de archivos de adjuntos de actividades
    cargarGrillaAdjuntos: function (template, visador_true){
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/MantenedorActividades/cargarGrillaAdjuntos', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            }else{
                $("iframe").contents().find("div#lista_adjuntos").html(response);
            }
        }, 'html');
    },

	//funcion para borrar adjuntos temporales de actividades
	borrarAdjunto: function (indice, template){
        var visador = 0;
        if (template !== undefined) {
            visador = 1;
        }
        $.post(BASE_URI + 'index.php/MantenedorActividades/borrarAdjunto', {indice: indice, visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            }else{
                $("iframe").contents().find("div#lista_adjuntos").html(response);
            }
        }, 'html');
    },
	
	//funcion para modificar actividades
	modificarActividad: function (form, btn){
        /*
        realizar validacion formulario
        */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
		
		if(form.id_tipo_respuesta.value == 0){
            msg_error += '- Debe seleccionar tipo de respuesta<br/>';
            error = true;
        }

        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });            
        }else{
            var formulario = $(form).serialize();
            
            $.post(BASE_URI + 'index.php/MantenedorActividades/modificarActividad', {data: formulario}, function (response) {
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorActividades/index';
                    });
                }else{
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
    },	
	
	//funcion para modificar actividades
	modificarActividadModificada: function (form, btn){
        /*
        realizar validacion formulario
        */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
		
		if(form.id_tipo_respuesta.value == 0){
            msg_error += '- Debe seleccionar tipo de respuesta<br/>';
            error = true;
        }

        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });            
        }else{
            var formulario = $(form).serialize();
            
            $.post(BASE_URI + 'index.php/MantenedorActividades/modificarActividadModificada', {data: formulario}, function (response) {
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorActividades/index';
                    });
                }else{
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