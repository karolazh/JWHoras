
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
									location.href = BASE_URI + "index.php/Mantenedor/usuario";
								}, 2000);
							} else {
								xModal.info(data.mensaje);
							}
            }
        }); 
	}

}

	$("#btnCambioUsuario").livequery(function(){
		btn	= this;
        $(btn).click(function(e){
			btn.disabled = true;
			var btnTexto = $(btn).html();
			$(btn).html('Cambiando...');

			var parametros = $("#form").serialize();
			$.ajax({
				dataType	: "json",
				cache		: false,
				async		: true,
				data		: parametros,
				type		: "post",
				url			: BASE_URI + "index.php/Mantenedor/procesarCambio", 
				error		: function(xhr, textStatus, errorThrown){
								xModal.info('Error al cambiar de usuario.');
				},
				success		: function(data){
								if(data.correcto){
									xModal.success('Se procederá con el Cambio de Usuario');
									setTimeout(function () {
										location.href = BASE_URI;
									}, 2000);
								}else{
									xModal.info(data.mensaje);
								}
				}
			});

			$(btn).html(btnTexto).attr('disabled', false);
        });

	});

	/*
	$(".btnCambioUsuarioVolver").livequery(function(){
		$(this).unbind( "click" );
        $(this).click(function(e){
			var userID = $(this).attr("data");
			bootbox.confirm({
				message: "¿ Confirma desactivar el reemplazo de usuario ?",
				buttons: {
					confirm: {
						label: 'Si',
						className: 'btn-success'
					},
					cancel: {
						label: 'No',
						className: 'btn-default'
					}
				},
				callback: function (result) {
						if(result){
							$.get(siteUrl + "session/impersonar/userID/" + userID)
								.done(function(data) {
									window.location.href = siteUrl; //"/Home/dashboard";
								}).fail(function(data) {
								});
						}
				}
			});
        });
    });
	*/

	$(".select2").select2({
							language: "es",
							//tags: false,
							//placeholder: "Seleccione",
							//theme: "classic",
							//minimumResultsForSearch: -1
							dropdownParent: $(".modal.fade.in")
						});