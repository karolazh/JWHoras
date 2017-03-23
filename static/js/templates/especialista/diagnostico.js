$("#guardar").on('click', function (e) {
	var button_process			= buttonStartProcess($(this), e);
	var parametros				= $("#form").serializeArray();
	var cie10					= $("#cie10").attr("selected",true).val();
	var cie102					= $("#cie102").attr("selected",true).val();
	var cie103					= $("#cie103").attr("selected",true).val();
	var gl_observacion			= $("#gl_observacion").val();
	var gl_diagnostico			= $("#gl_diagnostico").val();
	
	if (cie10 == 0) {
		xModal.danger('- El campo CIE10 es obligatorio');	
	} else if (cie102 == 0) {
		xModal.danger('- El campo CIE10 es obligatorio');	
	} else if (cie103 == 0) {
		xModal.danger('- El campo CIE10 es obligatorio');	
	} else if (gl_diagnostico == '' ) {
		xModal.danger('- El campo Diagnóstico es obligatorio');	
	} else if (gl_observacion == '' ) {
		xModal.danger('- El campo Observación es obligatorio');
	} else {
		$.ajax({
			dataType: "json",
			cache	: false,
			async	: true,
			data	: parametros,
			type	: "post",
			url		: BASE_URI + "index.php/Especialista/GuardarDiagnostico",
			error	: function (xhr, textStatus, errorThrown) {
						xModal.danger('Error: No se pudo Guardar.');
					},
			success	: function (data) {
						if (data.correcto) {
							xModal.success('Éxito: Se Ingresó Diagnóstico!');
							setTimeout(function () {
								location.href = BASE_URI + "index.php/Especialista";
							}, 2000);
						} else {
							xModal.info('Error: No se pudo Ingresar Diagnóstico');
						}
					}
		});
	}
	buttonEndProcess(button_process);

});


var CIE10 ={
    
cargarSeccionporCapitulo : function(cie10,combo,seccion){
            console.log(cie10);
		if(cie10 != 0){
			$.post(BASE_URI+'index.php/Especialista/cargarSeccionporCapitulo',{cie10:cie10},function(response){
				if(response.length > 0){
					var total = response.length;
					var options = '<option value="0">Seleccione CIE10 L2</option>';
					for(var i=0; i<total; i++){
						if(seccion == response[i].id_seccion){
							options += '<option value="'+response[i].id_seccion+'" selected >'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';	
						}else{
							options += '<option value="'+response[i].id_seccion+'">'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';
						}
						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
                    $('#'+combo).html('<option value="0">Seleccione CIE10 L2</option>');
		}
	},
    
cargarGrupoporSeccion : function(seccion,combo,grupo){
            console.log(seccion);
		if(seccion != 0){
			$.post(BASE_URI+'index.php/Especialista/cargarGrupoporSeccion',{seccion:seccion},function(response){
				if(response.length > 0){
					var total = response.length;
					var options = '<option value="0">Seleccione CIE10 L3</option>';
					for(var i=0; i<total; i++){
						if(grupo == response[i].id_grupo){
							options += '<option value="'+response[i].id_grupo+'" selected >'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';	
						}else{
							options += '<option value="'+response[i].id_grupo+'">'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';
						}
						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
                    $('#'+combo).html('<option value="0">Seleccione CIE10 L3</option>');
		}
	},
    
cargarCIE10porGrupo : function(grupo,combo,cie10){
            console.log(grupo);
		if(grupo != 0){
			$.post(BASE_URI+'index.php/Especialista/cargarCIE10porGrupo',{grupo:grupo},function(response){
				if(response.length > 0){
					var total = response.length;
					var options = '<option value="0">Seleccione CIE10 L4</option>';
					for(var i=0; i<total; i++){
						if(cie10 == response[i].id_cie10){
							options += '<option value="'+response[i].id_cie10+'" selected >'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';	
						}else{
							options += '<option value="'+response[i].id_cie10+'">'+response[i].gl_codigo+' '+response[i].gl_descripcion+'</option>';
						}
						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
                    $('#'+combo).html('<option value="0">Seleccione CIE10 L4</option>');
		}
	}

};

$("#cie10").on('change', function (e) {
	if ($("#cie102").val() > 0 || $("#cie103").val() > 0 || $("#cie104").val() > 0) {
		//$("#cie102").val(0);
		$("#cie103")
				.empty()
				.append('<option value="0">Seleccione CIE10 L3</option>');
		$("#cie104")
				.empty()
				.append('<option value="0">Seleccione CIE10 L4</option>');
	}
});

$("#cie102").on('change', function (e) {
	if ($("#cie103").val() > 0 || $("#cie104").val() > 0) {
		$("#cie104")
				.empty()
				.append('<option value="0">Seleccione CIE10 L4</option>');
	}
});
