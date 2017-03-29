/* global BASE_URI */

$("#guardarPlan").on('click', function (e) {
	var button_process			= buttonStartProcess($(this), e);
	var parametros				= $("#formPlan").serializeArray();
	var gl_observacion			= $("#gl_observacion").val();
	var id_tipo_especialidad	= $("#id_tipo_especialidad").val();

	if (gl_observacion == '' ) {
		xModal.danger('- El campo Observación es obligatorio');
	}else if (id_tipo_especialidad == 0 ) {
		xModal.danger('- El campo Especialidad es obligatorio');	
	}else {
		$.ajax({
			dataType: "json",
			cache	: false,
			async	: true,
			data	: parametros,
			type	: "post",
			url		: BASE_URI + "index.php/Medico/GuardarPlan",
			error	: function (xhr, textStatus, errorThrown) {
						xModal.danger('Error: No se pudo guardar.');
					},
			success	: function (data) {
						if (data.correcto) {
							xModal.success('Éxito: Se Ingresó Plan de Tratamiento!');
							setTimeout(function () {
								location.href = BASE_URI + "index.php/Medico";
							}, 2000);
						} else {
							xModal.info('Error: No se pudo Ingresar Plan de Tratamiento');
						}
					}
		});
	}
	buttonEndProcess(button_process);

});