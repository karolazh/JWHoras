//Boton Guardar Agresor
$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();
	
	//Validar Vacios y otros
	//Datos Pacientes para UPDATE
		if ($('#gl_nacionalidad').val() == "") {
			parametros.push({
				"name": 'gl_nacionalidad',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_nacionalidad',
				"value": "'" + $('#gl_nacionalidad').val() + "'"
			});
		}

		if ($('#gl_direccion_alternativa').val() == "") {
			parametros.push({
				"name": 'gl_direccion_alternativa',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_direccion_alternativa',
				"value": "'" + $('#gl_direccion_alternativa').val() + "'"
			});
		}

		if ($('#id_estado_civil').val() == 0) {
			parametros.push({
				"name": 'id_estado_civil',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_estado_civil',
				"value": $('#id_estado_civil').val()
			});
		}

		if ($('#nr_hijos').val() == "") {
			parametros.push({
				"name": 'nr_hijos',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'nr_hijos',
				"value": $('#nr_hijos').val()
			});
		}

		if ($('#id_tipo_ocupacion').val() == 0) {
			parametros.push({
				"name": 'id_tipo_ocupacion',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_ocupacion',
				"value": $('#id_tipo_ocupacion').val()
			});
		}

		if ($('#id_tipo_escolaridad').val() == 0) {
			parametros.push({
				"name": 'id_tipo_escolaridad',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_escolaridad',
				"value": $('#id_tipo_escolaridad').val()
			});
		}

		if ($('#fc_reconoce').val() == "") {
			parametros.push({
				"name": 'fc_reconoce',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'fc_reconoce',
				"value": "'" + $('#fc_reconoce').val() + "'"
			});
		}

		if ($('#fc_reconoce').val() == "") {
			parametros.push({
				"name": 'fc_reconoce',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'fc_reconoce',
				"value": "'" + $('#fc_reconoce').val() + "'"
			});
		}

		if ($('#fc_hora_reconoce').val() == "") {
			parametros.push({
				"name": 'fc_hora_reconoce',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'fc_hora_reconoce',
				"value": "'" + $('#fc_hora_reconoce').val() + "'"
			});
		}

		if ($('#gl_acompañante').val() == "") {
			parametros.push({
				"name": 'gl_acompañante',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_acompañante',
				"value": "'" + $('#gl_acompañante').val() + "'"
			});
		}

	//Datos Agresor para INSERT
		if ($('#id_tipo_riesgo_1').is(':checked')) {
			parametros.push({
				"name": 'id_tipo_riesgo',
				"value": 1
			});
		} else if ($('#id_tipo_riesgo_2').is(':checked')) {
			parametros.push({
				"name": 'id_tipo_riesgo',
				"value": 2
			});
		} else if ($('#id_tipo_riesgo_3').is(':checked')) {
			parametros.push({
				"name": 'id_tipo_riesgo',
				"value": 3
			});
		} else if ($('#id_tipo_riesgo_4').is(':checked')) {
			parametros.push({
				"name": 'id_tipo_riesgo',
				"value": 4
			});
		} else {
			parametros.push({
				"name": 'id_tipo_riesgo',
				"value": 'NULL'
			});
		}

		if ($('#id_tipo_vinculo').val() == 0) {
			parametros.push({
				"name": 'id_tipo_vinculo',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_vinculo',
				"value": $('#id_tipo_vinculo').val()
			});
		}

		if ($('#gl_nombres_agresor').val() == "") {
			parametros.push({
				"name": 'gl_nombres_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_nombres_agresor',
				"value": "'" + $('#gl_nombres_agresor').val() + "'"
			});
		}

		if ($('#gl_apellidos_agresor').val() == "") {
			parametros.push({
				"name": 'gl_apellidos_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_apellidos_agresor',
				"value": "'" + $('#gl_apellidos_agresor').val() + "'"
			});
		}

		if ($('#gl_rut_agresor').val() == "") {
			parametros.push({
				"name": 'gl_rut_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'gl_rut_agresor',
				"value": "'" + $('#gl_rut_agresor').val() + "'"
			});
		}

		if ($('#fc_nacimiento_agresor').val() == "") {
			parametros.push({
				"name": 'fc_nacimiento_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'fc_nacimiento_agresor',
				"value": "'" + $('#fc_nacimiento_agresor').val() + "'"
			});
		}

		if ($('#id_comuna_vive').val() == 0) {
			parametros.push({
				"name": 'id_comuna_vive',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_comuna_vive',
				"value": $('#id_comuna_vive').val()
			});
		}

		if ($('#id_comuna_trabaja').val() == 0) {
			parametros.push({
				"name": 'id_comuna_trabaja',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_comuna_trabaja',
				"value": $('#id_comuna_trabaja').val()
			});
		}

		if ($('#id_estado_civil_agresor').val() == 0) {
			parametros.push({
				"name": 'id_estado_civil_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_estado_civil_agresor',
				"value": $('#id_estado_civil_agresor').val()
			});
		}

		if ($('#nr_hijos_agresor').val() == "") {
			parametros.push({
				"name": 'nr_hijos_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'nr_hijos_agresor',
				"value": $('#nr_hijos_agresor').val()
			});
		}

		if ($('#nr_hijos_en_comun').val() == "") {
			parametros.push({
				"name": 'nr_hijos_en_comun',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'nr_hijos_en_comun',
				"value": $('#nr_hijos_en_comun').val()
			});
		}

		if ($('#id_tipo_ocupacion_agresor').val() == 0) {
			parametros.push({
				"name": 'id_tipo_ocupacion_agresor',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_ocupacion_agresor',
				"value": $('#id_tipo_ocupacion_agresor').val()
			});
		}

		if ($('#id_actividad_economica').val() == 0) {
			parametros.push({
				"name": 'id_actividad_economica',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_actividad_economica',
				"value": $('#id_actividad_economica').val()
			});
		}

		if ($('#nr_ingreso_mensual').val() == "") {
			parametros.push({
				"name": 'nr_ingreso_mensual',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'nr_ingreso_mensual',
				"value": $('#nr_ingreso_mensual').val()
			});
		}

		if ($('#id_tipo_sexo').val() == 0) {
			parametros.push({
				"name": 'id_tipo_sexo',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_sexo',
				"value": $('#id_tipo_sexo').val()
			});
		}

		if ($('#id_tipo_genero').val() == 0) {
			parametros.push({
				"name": 'id_tipo_genero',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_tipo_genero',
				"value": $('#id_tipo_genero').val()
			});
		}

		if ($('#id_orientacion_sexual').val() == 0) {
			parametros.push({
				"name": 'id_orientacion_sexual',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'id_orientacion_sexual',
				"value": $('#id_orientacion_sexual').val()
			});
		}

		if ($('#nr_denuncias_por_violencia').val() == "") {
			parametros.push({
				"name": 'nr_denuncias_por_violencia',
				"value": 'NULL'
			});
		} else {
			parametros.push({
				"name": 'nr_denuncias_por_violencia',
				"value": $('#nr_denuncias_por_violencia').val()
			});
		}
		
		var cant_pre = $('#cant_pre').val();
		parametros.push({
			"name": 'cant_pre',
			"value": cant_pre
		});
		
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
					xModal.danger('Error: No se pudo Ingresar un nuevo Registro');
				}
			}
		});
		buttonEndProcess(button_process);
});

$(".id_tipo_violencia").livequery(function () {
	$(this).on('change', function (e) {
		var valor = $(this).val();
		var i = $(this).attr("data");
	});
});