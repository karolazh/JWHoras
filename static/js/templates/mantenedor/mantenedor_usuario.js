
var Mantenedor_usuario = {

	editarUsuario : function(form,btn){
		btn.disabled	= true;
		//$(form).submit();
        var parametros = $("#form").serialize();
        $.ajax({         
            dataType	: "json",
            cache		: false,
            async		: true,
            data		: parametros,
            type		: "post",
            url			: BASE_URI + "index.php/Mantenedor/editarUsuarioBD", 
            error		: function(xhr, textStatus, errorThrown){
							xModal.info('Error al Actualizar el usuario.');
            },
            success		: function(data){
							if(data.correcto){
								xModal.success(data.mensaje);
								setTimeout(function () {
									location.href = BASE_URI + "index.php/Mantenedor/Usuario";
								}, 2000);
							} else {
								xModal.info(data.mensaje);
							}
            }
        }); 
	}

	
}