$("#gl_tipo_riesgo").on('change', function (e) {
	if ($('#gl_tipo_riesgo').val()==1) {
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#BDB76B");
        } else if ($('#gl_tipo_riesgo').val()==2){
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#CD853F");
        } else if ($('#gl_tipo_riesgo').val()==3){
            $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#FF0000");
        } else if ($('#gl_tipo_riesgo').val()==4){
           $('#gl_tipo_riesgo').css("borderColor", "");
            $('#gl_tipo_riesgo').css("borderColor", "#FF0000"); 
        } else if ($('#gl_tipo_riesgo').val()==0){
            $('#gl_tipo_riesgo').css("borderColor", ""); 
        }
});

//Boton Guardar EMPA
$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();
	
	
	
		$.ajax({
		dataType: "json",
		cache: false,
		async: true,
		data: parametros,
		type: "post",
		url: BASE_URI + "index.php/Reconoce/guardar",
		error: function (xhr, textStatus, errorThrown) {
			xModal.danger('Error: No se pudo Ingresar un nuevo Registro');
		},
		success: function (data) {
			if (data.correcto) {
				xModal.success('Éxito: Se Ingresó nuevo Registro!');
			} else {
				xModal.info('Error: No se pudo Ingresar un nuevo Registro');
			}
		}
	});
	buttonEndProcess(button_process);
});