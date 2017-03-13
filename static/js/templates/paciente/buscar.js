//Boton Buscar 
$("#buscar").livequery(function () {
	$(this).on('click', function (e) {
		var button_process	= buttonStartProcess($(this), e);
		var parametros		= $("#form").serializeArray();
		
		$.ajax({
			dataType: "json",
			cache	: false,
			async	: true,
			data	: parametros,
			type	: "post",
			url		: BASE_URI + "index.php/Paciente/realizarBusqueda",
			error	: function (xhr, textStatus, errorThrown) {
						xModal.danger('Error: No se pudo Realizar la Búsqueda');
					},
			success	: function (data) {
						if (data.correcto) {
							//xModal.success('Éxito: Encontrado!');
						} else {
							xModal.info('Error: No se pudo Realizar la Búsqueda');
						}
					}
		});
		buttonEndProcess(button_process);
	});
});