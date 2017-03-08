/* global BASE_URI */

$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();

		$.ajax({
			dataType: "json",
			cache: false,
			async: true,
			data: parametros,
			type: "post",
			url: BASE_URI + "index.php/Medico/GuardarPlan",
			error: function (xhr, textStatus, errorThrown) {
				xModal.danger('Error: No se pudo guardar.');
			},
			success: function (data) {
				if (data.correcto) {

					xModal.success('Éxito: Se Ingresó nuevo Registro!');
					setTimeout(function () {
						location.href = BASE_URI + "index.php/Paciente";
					}, 2000);
				} else {
					xModal.info('Error: No se pudo Ingresar un nuevo Registro');
				}
			}
		});
	
	buttonEndProcess(button_process);

});