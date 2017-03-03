var MantenedorArchivos = {

   //funcion para guardar carpeta
   guardarNuevaSolicitud: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';

        if(form.nombre.value == ""){
            msg_error += '- Debe Ingresar Nombre<br/>';
            error = true;
        }
        
        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });            
        }else{
            var formulario = $(form).serialize();
            
            $.post(BASE_URI + 'index.php/MantenedorArchivos/guardarNuevaSolicitud', {data: formulario}, function (response) {
                if (response.estado == true) {
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/index';
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

	//funcion para guardar subcarpeta
    guardarNuevaSubcarpeta: function (form, btn){
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        if (form.nombre.value == "") {
            msg_error += '- Debe Ingresar Nombre<br/>';
            error = true;
        }
        
        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });            
        }else{
            var formulario = $(form).serialize();
            $.post(BASE_URI + 'index.php/MantenedorArchivos/guardarNuevaSubcarpeta', {data: formulario}, function (response) {
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/index';
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

	//funcion para actualizar carpeta
    updateArchivoCarpeta: function (form, btn) {
        /*
         realizar validacion formulario
         */
        btn.disabled = true;

        var error = false;
        var msg_error = '';

        var nombre            = form.nombre_archivo.value;
        var cd_solicitud      = form.cd_solicitud_fk_archivo.value;
        var id_estado_archivo = form.id_estado_archivo.value;
              
        if(nombre == ""){
            msg_error += '- Debe Ingresar Nombre de archivo<br/>';
            error = true;
        }

        if(id_estado_archivo == 0){
            msg_error += '- Debe Seleccionar estado Archivo<br/>';
            error = true;
        }        
        
        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        }else{
            var formulario = $(form).serialize();
            $.post(BASE_URI + 'index.php/MantenedorArchivos/updateArchivoCarpeta', {data: formulario}, function (response) {
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/revisarSolicitud/'+ cd_solicitud;
                    });

                }else{
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });
                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema. Intente nuevamente upate archivo",function(){
                    btn.disabled = false;
                });
            });
        }
    },

	//funcion para guardar nuevo archivo en carpeta
    guardarNuevoArchivo: function (form, btn) {
        
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        var cd_solicitud = form.id_carpeta_archivo.value;

        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        }else{
            var formulario = $(form).serialize();
            $.post(BASE_URI + 'index.php/MantenedorArchivos/guardarNuevoArchivo', {data: formulario}, function (response) {
                
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/revisarSolicitud/'+ cd_solicitud;
                    });
                }else{
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });
                }
            }, 'json').fail(function (){
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });
            });
        }
    },

	//funcion para guardar nuevo archivo en subcarpeta
    guardarNuevoArchivoSubCarpeta: function (form, btn) {
        
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        var cd_solicitud = form.id_carpeta_archivo.value;

        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        }else{
            var formulario = $(form).serialize();
            
            $.post(BASE_URI + 'index.php/MantenedorArchivos/guardarNuevoArchivoSubCarpeta', {data: formulario}, function (response) {
                
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/revisarSubCarpeta/'+ cd_solicitud;
                    });
                }else{
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });
                }
            }, 'json').fail(function(){
                xModal.danger("Error en sistema. Intente nuevamente",function(){
                    btn.disabled = false;
                });
            });
        }
    },

	//funcion para guardar nuevo archivo en version
    guardarNuevoArchivoVersion: function (form, btn) {
        
        btn.disabled = true;

        var error = false;
        var msg_error = '';
        var cd_solicitud = form.id_carpeta_archivo.value;

        if(error){
            xModal.danger(msg_error,function(){
                btn.disabled = false;
            });
        }else{
            var formulario = $(form).serialize();
            
            $.post(BASE_URI + 'index.php/MantenedorArchivos/guardarNuevoArchivoVersion', {data: formulario}, function (response) {
                
                if(response.estado == true){
                    xModal.success(response.mensaje,function(){
                        location.href = BASE_URI + 'index.php/MantenedorArchivos/revisarSolicitud/'+ cd_solicitud;
                    });
                }else{
                    xModal.danger(response.mensaje,function(){
                        btn.disabled = false;
                    });
                }
            }, 'json').fail(function () {
                xModal.danger("Error en sistema en sub version. Intente nuevamente",function(){
                    btn.disabled = false;
                });
            });
        }
    },

	//funcion para subir documentos
    subirArchivo: function (form){
        $(form).submit(function () {
            $.post(BASE_URI + 'index.php/MantenedorArchivos/cargarGrillaAdjuntos', function (response) {
                $("#lista_adjuntos").html(response);
            }, 'html');
        });
    },

	//funcion para cargas grilla de adjuntos
    cargarGrillaAdjuntos: function (template, visador_true){
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/cargarGrillaAdjuntos', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos").html(response);
            }
        }, 'html');
    },

	//funcion para cargar grilla de adjuntos nuevos
    cargarGrillaAdjuntosNuevos: function (template, visador_true){
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/cargarGrillaAdjuntosNuevos', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos_nuevos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos_nuevos").html(response);
            }
        }, 'html');
    },

	//funcion para cargar grilla de adjuntos nuevos en las subcarpeta
    cargarGrillaAdjuntosNuevosSubCarpetas: function (template, visador_true){
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/cargarGrillaAdjuntosNuevosSubCarpetas', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos_nuevos_sub_carpetas").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos_nuevos_sub_carpetas").html(response);
            }
        }, 'html');
    },

	//funcion para cargar grilla de adjuntos nuevos versionados
    cargarGrillaAdjuntosNuevosVersionado: function (template, visador_true){
        var visador = 0;
        if (visador_true !== undefined) {
            visador = visador_true;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/cargarGrillaAdjuntosNuevosVersionado', {visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos_nuevos_versiones").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos_nuevos_versiones").html(response);
            }
        }, 'html');
    },
	
	//funcion para borrar adjuntos
    borrarAdjunto: function (indice, template){
        var visador = 0;
        if (template !== undefined) {
            visador = 1;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/borrarAdjunto', {indice: indice, visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos").html(response);
            }
        }, 'html');
    },

	//funcion para borrar adjuntos nuevos
    borrarAdjuntoNuevo: function (indice, template){
        var visador = 0;
        if (template !== undefined) {
            visador = 1;
        }
        $.post(BASE_URI + 'index.php/MantenedorArchivos/borrarAdjuntoNuevo', {indice: indice, visador: visador}, function (response) {
            if (template === undefined) {
                $("#lista_adjuntos_nuevos").html(response);
            } else {
                $("iframe").contents().find("div#lista_adjuntos_nuevos").html(response);
            }
        }, 'html');
    }
}