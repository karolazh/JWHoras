
var Adjunto = {

	guardarAdjunto : function(form,btn){
		btn.disabled	= true;
		var btnTexto	= $(btn).html();
		$(btn).html('Guardando...');

		if(form.adjunto.value == ""){
			xModal.danger('Error: Debe seleccionar un archivo para adjuntarlo');
			$(btn).html(btnTexto).attr('disabled',false);			
		}else{
			$(form).submit();
		}
	},

	cargarListadoAdjuntos : function(contenedor){
		$.post(BASE_URI+'/adjunto/cargarListadoAdjuntos',function(response)
		{			
			parent.$("#listado-adjuntos").html(response).show();
		});
	},

	borrarAdjunto : function(adjunto){
		$.post(BASE_URI+'/adjunto/borrarAdjunto',{adjunto:adjunto},function(response)
		{
			$("#listado-adjuntos").html(response);
		});
	},
	
}