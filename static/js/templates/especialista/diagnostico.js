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