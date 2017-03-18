
var Mantenedor_perfil = {

	agregarPerfil : function(form,btn){
		//$(form).submit();
        var parametros = $("#form").serializeArray();
		var arrOpciones = $('input[type=checkbox]:checked').serializeArray();
		parametros.push({
				"name": 'arr_opcion',
				"value": JSON.stringify(arrOpciones)
			});
        $.ajax({         
            dataType	: "json",
            cache		: false,
            async		: true,
            data		: parametros,
            type		: "post",
            url			: BASE_URI + "index.php/Mantenedor/agregarPerfilBD", 
            error		: function(xhr, textStatus, errorThrown){
							xModal.info('Error al Actualizar el perfil.');
							alert(errorThrown);
            },
            success		: function(data){
							if(data.correcto){
								xModal.success(data.mensaje);
								setTimeout(function () {
									location.href = BASE_URI + "index.php/Mantenedor/perfil";
								}, 2000);
							} else {
								xModal.info(data.mensaje);
							}
            }
        }); 
	},
	editarPerfil : function(form,btn){
		//$(form).submit();
        var parametros = $("form").serializeArray();
        $.ajax({         
            dataType	: "json",
            cache		: false,
            async		: true,
            data		: parametros,
            type		: "post",
            url			: BASE_URI + "index.php/Mantenedor/editarPerfilBD", 
            error		: function(xhr, textStatus, errorThrown){
							xModal.info('Error al Editar el perfil.');
							alert(errorThrown);
            },
            success		: function(data){
							if(data.correcto){
								xModal.success(data.mensaje);
								setTimeout(function () {
									location.href = BASE_URI + "index.php/Mantenedor/perfil";
								}, 2000);
							} else {
								xModal.info(data.mensaje);
							}
            }
        }); 
	}

	
}