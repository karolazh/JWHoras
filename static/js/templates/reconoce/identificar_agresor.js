//Boton Guardar Agresor
$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();
	var gl_rut_agresor = $("#gl_rut_agresor").val();
	var gl_run_pass_agresor = $("#gl_run_pass_agresor").val();
	
	//Validar Caracterizacion de Violencia
	var cant_pre = $('#cant_pre').val();
	var bool_tipo_violencia = false;
	var bool_tipo_riesgo = false;
	for (i = 1; i <= cant_pre; i++) {
		valor = $('input:radio[name=id_tipo_violencia_' + i + ']:checked').val();
		if (valor != 1 && valor != 2 && valor != 3 && valor != 4) {
			bool_tipo_violencia = true;
		}
	}
	if (!$('#id_tipo_riesgo_1').is(':checked') && !$('#id_tipo_riesgo_2').is(':checked') && !$('#id_tipo_riesgo_3').is(':checked') && !$('#id_tipo_riesgo_4').is(':checked')) {
			bool_tipo_riesgo = true;
		}
	//Validar Rut/Run/Pasaporte Agresor
	if ((!$('#chkextranjero').is(':checked')) && gl_rut_agresor == '') {
		xModal.danger('- El campo RUT de Agresor es Obligatorio');
	} else if ($('#chkextranjero').is(':checked') && gl_run_pass_agresor == ''){
		xModal.danger('- El campo RUN/Pasaporte de Agresor es Obligatorio');
	} else if (bool_tipo_violencia){
		xModal.danger('- El cuadro Tipo de Violencia es Obligatorio');
	} else if (bool_tipo_riesgo){
		xModal.danger('- El Tipo de Riesgo es Obligatorio');
	} else {
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
			
			if ($('#chkextranjero').is(':checked')) {
			parametros.push({
				"name": 'bo_extranjero',
				"value": 1
			});
			} else {
				parametros.push({
					"name": 'bo_extranjero',
					"value": 0
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
			
			if ($('#gl_run_pass_agresor').val() == "") {
				parametros.push({
					"name": 'gl_run_pass_agresor',
					"value": 'NULL'
				});
			} else {
				parametros.push({
					"name": 'gl_run_pass_agresor',
					"value": "'" + $('#gl_run_pass_agresor').val() + "'"
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

			for(i=1; i<=cant_pre; i++){
					valor = $('input:radio[name=id_tipo_violencia_'+i+']:checked').val();
					if (valor != 1 && valor != 2 && valor != 3 && valor != 4) {
						parametros.push({
							"name": 'id_tipo_violencia_'+i,
							"value": 'NULL'
						});
					} else {
						parametros.push({
							"name": 'id_tipo_violencia_'+i,
							"value": valor
						});
					}
			}
			$.ajax({
				dataType: "json",
				cache: false,
				async: true,
				data: parametros,
				type: "post",
				url: BASE_URI + "index.php/Reconoce/guardar",
				error: function (xhr, textStatus, errorThrown) {
					xModal.danger('Error: No se pudo Ingresar los datos.');
				},
				success: function (data) {
					if (data.correcto) {
						xModal.success('Éxito: Se Guardó la información.!');
						setTimeout(function () {
							location.href = BASE_URI + "index.php/Paciente";
						}, 2000);
					} else {
						xModal.danger('Error: No se pudo Ingresar los datos.<br>Favor comunicar a Mesa de Ayuda.');
					}
				}
			});

	}
		buttonEndProcess(button_process);
});

$("#chkextranjero").on('click', function (e) {
	if ($('#chkextranjero').is(':checked')) {
		$('#nacional').hide();
		$('#extranjero').show();
		var id_prevision = $('#opcionPrevision').val();
		if (id_prevision === "1") {
			$('#groupFonasaExtranjero').removeClass("hidden");
		}
	} else {
		$('#nacional').show();
		$('#extranjero').hide();
		$('#groupFonasaExtranjero').addClass("hidden");
	}
});