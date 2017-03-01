//Cuando Carga FORM
$("#form").ready(function () {
    var imc = $('#gl_imc').val();
    
    //funcion mensaje span IMC
    mensajeIMC(imc);
    
});

//Poner Mensaje en span segun IMC
function mensajeIMC(imc){
    //calculamos circunferencia abdominal
	//Bajo peso
	if (imc > 0 && imc < 18.50) {
		$('#gl_imc').css("borderColor", "");
		$('#gl_imc').parent().find("span.help-block").css("color", "");
		$('#gl_imc').parent().removeClass("has-error");
		$('#gl_imc').parent().removeClass("has-success");
		$('#gl_imc').css("borderColor", "#BDB76B");
		$('#gl_imc').parent().find("span.help-block").css("color", "#BDB76B");
		if (imc < 16.00) {
			$("#id_clasificacion_imc").val(1);
			mensaje = "Bajo Peso / Delgadez Severa";
		}
		if (imc >= 16.00 && imc < 17.00) {
			$("#id_clasificacion_imc").val(2);
			mensaje = "Bajo Peso / Delgadez Moderada";
		}
		if (imc >= 17.00 && imc < 18.50) {
			$("#id_clasificacion_imc").val(3);
			mensaje = "Bajo Peso / Delgadez Aceptable";
		}
	}
	//Peso Normal
	if (imc >= 18.50 && imc <= 24.99) {
		$("#id_clasificacion_imc").val(4);
		$('#gl_imc').css("borderColor", "");
		$('#gl_imc').parent().find("span.help-block").css("color", "");
		$('#gl_imc').parent().removeClass("has-error");
		$('#gl_imc').parent().addClass("has-success");
		mensaje = "Peso Normal";
	}
	//Sobre Peso
	if (imc >= 25.00 && imc < 30.00) {
		$("#id_clasificacion_imc").val(5);
		$('#gl_imc').css("borderColor", "");
		$('#gl_imc').parent().find("span.help-block").css("color", "");
		$('#gl_imc').parent().removeClass("has-error");
		$('#gl_imc').parent().removeClass("has-success");
		$('#gl_imc').css("borderColor", "#FF4500");
		$('#gl_imc').parent().find("span.help-block").css("color", "#FF4500");
		mensaje = "Sobrepeso / Pre Obeso (riesgo)";
	}
	//Obeso
	if (imc >= 30.00) {
		$('#gl_imc').css("borderColor", "");
		$('#gl_imc').parent().find("span.help-block").css("color", "");
		$('#gl_imc').parent().removeClass("has-success");
		$('#gl_imc').parent().addClass("has-error");
		if (imc >= 30.00 && imc < 35.00) {
			$("#id_clasificacion_imc").val(6);
			mensaje = "Obeso / Obeso Tipo I (riesgo moderado)";
		}
		if (imc >= 35.00 && imc < 40.00) {
			$("#id_clasificacion_imc").val(7);
			mensaje = "Obeso / Obeso Tipo II (riesgo severo)";
		}
		if (imc >= 40.00) {
			$("#id_clasificacion_imc").val(8);
			mensaje = "Obeso / Obeso Tipo III (riesgo muy severo)";
		}
	}
        
        $('#gl_imc').parent().find('span.help-block').html(mensaje);
        $('#gl_imc').parent().find('span.help-block').removeClass("hidden");
}

//Calcular IMC segun Peso y Altura
function calculaIMC()
{
//hacemos la llamada a los datos introducidos
	var peso = $('#gl_peso').val();
	var altura = $('#gl_estatura').val() / 100;
	var mensaje = "";
//calculamos el imc
	var imc = peso / (altura * altura);
	imc = imc.toFixed(2);

	//mensaje si no tiene valores y dar valor="" a gl_imc
	if ((peso == "") || (altura == "")) {
		xModal.danger("Ingrese Peso y Altura");
		imc = "";
	}

	//Si IMC es mayor a 30 Mostrar Diabetes
	if (imc > 30) {
		$("#glicemia").show();
		$("#antecedentes").hide();
	}
        //funcion mensaje span IMC
        mensajeIMC(imc);
	//enviamos resultados a la caja correspondiente
	$('#gl_imc').val(imc);
}


//Si Circunferencia Abdominal es mayor o igual a 88cm -> Consejería
$("#gl_circunferencia_abdominal").on('keyup', function (e) {
	if ($("#gl_circunferencia_abdominal").val() >= 88) {
		$('#gl_circunferencia_abdominal').parent().find('span.help-block').html("Mayor/Igual a 90 (Consejería Alimentación Sana y Actividad Física)");
		$('#gl_circunferencia_abdominal').parent().find('span.help-block').removeClass("hidden");
	} else {
		$('#gl_circunferencia_abdominal').parent().find('span.help-block').addClass("hidden");
	}
});

// Si Consume Alcohol muestra Boton para Hacer Cuestionario AUDIT
$(".bo_consume_alcohol").on('change', function (e) {
	if ($('#bo_consume_alcohol_0').is(':checked')) {
		$('#div_alcoholismo').hide();
	} else {
		$('#div_alcoholismo').show();
	}
});

//Según tipo de consumo mostrar Consejería AUDIT
$("#gl_puntos_audit").on('change', function (e) {
	if ($('#gl_puntos_audit').val() > 0) {

	} else {

	}
});

//Si Fuma muestra Consejería
$(".bo_fuma").on('change', function (e) {
	if ($('#bo_fuma_0').is(':checked')) {
		$('#lbl_fuma').hide();
	} else {
		$('#lbl_fuma').show();
	}
});

//Si PAS es >= 140 o PAD >= 90 Activar Funcionalidad de Agenda de Profesional
$("#gl_pas").on('keyup', function (e) {
	if ($("#gl_pad").val() >= 90 || $("#gl_pas").val() >= 140) {
		$('#verAgendaHipertension').show();
	} else {
		$('#verAgendaHipertension').hide();
	}
});
$("#gl_pad").on('keyup', function (e) {
	if ($("#gl_pad").val() >= 90 || $("#gl_pas").val() >= 140) {
		$('#verAgendaHipertension').show();
	} else {
		$('#verAgendaHipertension').hide();
	}
});

// Si tiene Antecedentes de Diabetes Mellitus mostrar/ocultar Examen Glicemia
$(".bo_antecedente").on('change', function (e) {
	if ($('#bo_antecedente_0').is(':checked')) {
		$('#glicemia').hide();
	} else {
		$('#glicemia').show();
	}
});

//(Si Examen de Glicemia es = 100-125 mh/dl consejería alimentacion) (Si valor >= 126 Referir confirmación diagnóstica)
$("#gl_glicemia").on('keyup', function (e) {
	if ($("#gl_glicemia").val() >= 100 && $("#gl_glicemia").val() <= 125) {
		$('#div_glicemia_toma').show();
	} else {
		$('#div_glicemia_toma').hide();
	}
	if ($("#gl_glicemia").val() > 125) {
		$('#verAgendaDiabetes').show();
		$('#div_glicemia_agenda').show();
	} else {
		$('#verAgendaDiabetes').hide();
		$('#div_glicemia_agenda').hide();
	}
});

//Si es trabajadora sexual o persona en centro reclusión -> mostrar VDRL y RPR
$(".bo_trabajadora_reclusa").on('change', function (e) {
	if ($('#bo_trabajadora_reclusa_0').is(':checked')) {
		$('#id_vdrl_rpr').hide();
	} else {
		$('#id_vdrl_rpr').show();
	}
});

//Si VDRL o RPR es positivo -> Activar Funcionalidad de Agenda para ITS
$(".bo_rpr").on('change', function (e) {

	if ((!$('#bo_rpr_1').is(':checked')) && (!$('#bo_vdrl_1').is(':checked'))) {
		$('#verAgendaSifilis').hide();
		$('#div_ITS_agenda').hide();
	} else {
		$('#verAgendaSifilis').show();
		$('#div_ITS_agenda').show();
	}
});

$(".bo_vdrl").on('change', function (e) {

	if ((!$('#bo_rpr_1').is(':checked')) && (!$('#bo_vdrl_1').is(':checked'))) {
		$('#verAgendaSifilis').hide();
		$('#div_ITS_agenda').hide();
	} else {
		$('#verAgendaSifilis').show();
		$('#div_ITS_agenda').show();
	}
});

//Si ha tenido Tos por + 15 dias -> mostrar Baciloscopia
$(".bo_tos_productiva").on('change', function (e) {

	if ($('#bo_tos_productiva_0').is(':checked')) {
		$('#id_baciloscopia').hide();
	} else {
		$('#id_baciloscopia').show();
	}
});

//Se ha realizado PAP? Si -> Muestra ultima fecha ; No -> Muestra Input para tomar fecha
$(".bo_pap_realizado").on('change', function (e) {
	if ($('#bo_pap_realizado_0').is(':checked')) {
		$('#tomar_fecha').show();
		$('#ultimo_pap').hide();
		$('#pap_vigente').hide();

	} else {
		$('#tomar_fecha').hide();
		$('#ultimo_pap').show();
		$('#pap_vigente').show();
	}
});

//PAP Vigente? (automático Calculando si es <=3 años) SI -> Vigente   NO -> No Vigente (Tomar hora para otro)
$("#fc_ultimo_pap").livequery(function () {
    $(this).on('change', function (e) {
        if ($(this).val() == "") {
            $('#bo_pap_vigente_1').prop('checked', false);
            $('#bo_pap_vigente_0').prop('checked', false);
        } else {
            var edad = calcularYear($(this).val());
            if (edad <= 3) {
                //check Si
                $('#bo_pap_vigente_1').prop('checked', true);
            } else {
                //check No
                $('#bo_pap_vigente_0').prop('checked', true);
            }
            $('#pap_vigente').show();
            $('#verAgendaPap1').show();
        }
    });
});
//Si valor colesterlo >= 200 y < 239 (Consejería Alimentaria y Actividad Fisica
//Si valor colesterol >= 240 (Referir a confirmación diagnóstica
$("#gl_colesterol").on('keyup', function (e) {
	var valor_colesterol = $('#gl_colesterol').val();
	if (valor_colesterol > 199 && valor_colesterol < 240) {
		$('#verAgendaDislipidemia').hide();
		$('#div_colesterol_agenda').hide()
		$('#div_colesterol').show();
		$('#div_consejeria_colesterol').show();
	} else if (valor_colesterol >= 240) {
		$('#div_colesterol').hide();
		$('#div_consejeria_colesterol').hide();
		$('#verAgendaDislipidemia').show();
		$('#div_colesterol_agenda').show();
	} else {
		$('#div_colesterol').hide();
		$('#div_consejeria_colesterol').hide();
		$('#verAgendaDislipidemia').hide();
		$('#div_colesterol_agenda').hide()
	}
});

//Si realizo Examen Cancer de mama Mostrar -> Ingrese Fecha
$(".bo_mamografia_realizada").on('change', function (e) {

	if ($('#bo_mamografia_realizada_0').is(':checked')) {
		$('#fecha_mamografia').hide();
		$('#mam_vigente').hide();
		$('#mam_resultado').hide();
	} else {
		$('#fecha_mamografia').show();
	}
});

//Examen Cancer de mama vigente?
$("#fc_mamografia").livequery(function () {
	$(this).on('change', function (e) {
            if ($(this).val() == "") {
                $('#bo_mamografia_vigente_1').prop('checked', false);
                $('#bo_mamografia_vigente_0').prop('checked', false);
            } else {
		var edad = calcularYear($(this).val());
		if (edad <= 1) {
			//check Si
			$('#bo_mamografia_vigente_1').prop('checked', true);
		} else {
			//check No
			$('#bo_mamografia_vigente_0').prop('checked', true);
		}
		$('#mam_vigente').show();
		$('#mam_resultado').show();
		$('#mam_requiere').show();
            }
	});
});

//Si requiere otra Mamografía Mostrar Resultado
$(".bo_mamografia_requiere").on('change', function (e) {

	if ($('#bo_mamografia_requiere').is(':checked')) {
		$('#mam_resultado2').hide();
		$('#requiere_mamografia').hide();
	} else {
		$('#mam_resultado2').show();
		$('#requiere_mamografia').show();
	}
});

//Boton Guardar AUDIT
$("#guardaraudit").livequery(function () {
	$(this).on('click', function (e) {
		var button_process = buttonStartProcess($(this), e);
		var parametros = $("#formAudit").serializeArray();
		parametros.push({
			"name": 'tablaPrincipal',
			"value": 1
		});
		$.ajax({
			dataType: "json",
			cache: false,
			async: true,
			data: parametros,
			type: "post",
			url: BASE_URI + "index.php/Empa/guardarAudit",
			error: function (xhr, textStatus, errorThrown) {
				xModal.danger('Error: No se pudo Ingresar Auditoria');
			},
			success: function (data) {
				if (data.correcto) {
					xModal.success('Éxito: Se Ingresó nueva Auditoria!');
				} else {
					xModal.info('Error: No se pudo Ingresar Auditoria');
				}
			}
		});
		buttonEndProcess(button_process);
		$("#gl_puntos_audit").val($("#total").val());
		xModal.close();
	});
});



$(".radio_audit").livequery(function () {
	$(this).on('change', function (e) {
		var valor = $(this).val();
		var i = $(this).attr("data");
		$("#puntos_" + i).val(valor);
		$("#puntos_" + i).trigger('change');
	});
});

$(".subTotal").livequery(function () {
	$(this).on('change', function (e) {
		var total = 0;
		for (i = 1; i <= 10; i++) {
			total = total + parseInt($("#puntos_" + i).val());
		}
		$("#total").val(total);
	});
});


//Boton Guardar EMPA
$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();

	if ($('#bo_consume_alcohol_1').is(':checked')) {
		parametros.push({
			"name": 'bo_consume_alcohol',
			"value": 1
		});
	} else if ($('#bo_consume_alcohol_0').is(':checked')) {
		parametros.push({
			"name": 'bo_consume_alcohol',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_consume_alcohol',
			"value": 'NULL'
		});
	}
	if ($('#gl_puntos_audit').val() == "") {
		parametros.push({
			"name": 'gl_puntos_audit',
			"value": 'NULL'
		});
	}
	if ($('#bo_fuma_1').is(':checked')) {
		parametros.push({
			"name": 'bo_fuma',
			"value": 1
		});
	} else if ($('#bo_fuma_0').is(':checked')) {
		parametros.push({
			"name": 'bo_fuma',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_fuma',
			"value": 'NULL'
		});
	}
	if ($('#gl_peso').val() == "") {
		parametros.push({
			"name": 'gl_peso',
			"value": ""
		});
	}
	if ($('#id_clasificacion_imc').val() == "") {
		parametros.push({
			"name": 'id_clasificacion_imc',
			"value": 'NULL'
		});
	}
	if ($('#gl_estatura').val() == "") {
		parametros.push({
			"name": 'gl_estatura',
			"value": ""
		});
	}
	if ($('#gl_circunferencia_abdominal').val() == "") {
		parametros.push({
			"name": 'gl_circunferencia_abdominal',
			"value": ""
		});
	}
	if ($('#gl_imc').val() == "") {
		parametros.push({
			"name": 'gl_imc',
			"value": ""
		});
	}
	if ($('#nr_ficha').val() == "") {
		parametros.push({
			"name": 'nr_ficha',
			"value": 'NULL'
		});
	}
	if ($('#id_sector').val() == "") {
		parametros.push({
			"name": 'id_sector',
			"value": 'NULL'
		});
	}
	if ($('#gl_pad').val() == "") {
		parametros.push({
			"name": 'gl_pad',
			"value": ""
		});
	}
	if ($('#gl_pas').val() == "") {
		parametros.push({
			"name": 'gl_pas',
			"value": ""
		});
	}
	if ($('#gl_glicemia').val() == "") {
		parametros.push({
			"name": 'gl_glicemia',
			"value": ""
		});
	}
	if ($('#bo_pap_toma_1').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_toma',
			"value": 1
		});
	} else if ($('#bo_pap_toma_0').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_toma',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_pap_toma',
			"value": 'NULL'
		});
	}
	if ($('#fc_ultimo_pap').val() == "") {
		parametros.push({
			"name": 'fc_ultimo_pap',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_ultimo_pap',
			"value": "'" + $('#fc_ultimo_pap').val() + "'"
		});
	}
	if ($('#gl_colesterol').val() == "") {
		parametros.push({
			"name": 'gl_colesterol',
			"value": ""
		});
	}
	if ($('#gl_observaciones_empa').val() == "") {
		parametros.push({
			"name": 'gl_observaciones_empa',
			"value": ""
		});
	}
	if ($('#bo_glicemia_toma').is(':checked')) {
		parametros.push({
			"name": 'bo_glicemia_toma',
			"value": 1
		});
	} else {
		parametros.push({
			"name": 'bo_glicemia_toma',
			"value": 0
		});
	}
	if ($('#bo_trabajadora_reclusa_1').is(':checked')) {
		parametros.push({
			"name": 'bo_trabajadora_reclusa',
			"value": 1
		});
	} else if ($('#bo_trabajadora_reclusa_0').is(':checked')) {
		parametros.push({
			"name": 'bo_trabajadora_reclusa',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_trabajadora_reclusa',
			"value": 'NULL'
		});
	}
	if ($('#bo_vdrl_1').is(':checked')) {
		parametros.push({
			"name": 'bo_vdrl',
			"value": 1
		});
	} else if ($('#bo_vdrl_0').is(':checked')) {
		parametros.push({
			"name": 'bo_vdrl',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_vdrl',
			"value": 'NULL'
		});
	}
	if ($('#bo_rpr_1').is(':checked')) {
		parametros.push({
			"name": 'bo_rpr',
			"value": 1
		});
	} else if ($('#bo_rpr_0').is(':checked')) {
		parametros.push({
			"name": 'bo_rpr',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_rpr',
			"value": 'NULL'
		});
	}
	if ($('#bo_tos_productiva_1').is(':checked')) {
		parametros.push({
			"name": 'bo_tos_productiva',
			"value": 1
		});
	} else if ($('#bo_tos_productiva_0').is(':checked')) {
		parametros.push({
			"name": 'bo_tos_productiva',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_tos_productiva',
			"value": 'NULL'
		});
	}
	if ($('#bo_baciloscopia_toma_1').is(':checked')) {
		parametros.push({
			"name": 'bo_baciloscopia_toma',
			"value": 1
		});
	} else if ($('#bo_baciloscopia_toma_0').is(':checked')) {
		parametros.push({
			"name": 'bo_baciloscopia_toma',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_baciloscopia_toma',
			"value": 'NULL'
		});
	}
	if ($('#bo_pap_realizado_1').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_realizado',
			"value": 1
		});
	} else if ($('#bo_pap_realizado_0').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_realizado',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_pap_realizado',
			"value": 'NULL'
		});
	}
	if ($('#bo_pap_vigente_1').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_vigente',
			"value": 1
		});
	} else if ($('#bo_pap_vigente_0').is(':checked')) {
		parametros.push({
			"name": 'bo_pap_vigente',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_pap_vigente',
			"value": 'NULL'
		});
	}
	if ($('#fc_tomar_pap').val() == "") {
		parametros.push({
			"name": 'fc_tomar_pap',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_tomar_pap',
			"value": "'" + $('#fc_tomar_pap').val() + "'"
		});
	}
	if ($('#bo_colesterol_toma').is(':checked')) {
		parametros.push({
			"name": 'bo_colesterol_toma',
			"value": 1
		});
	} else {
		parametros.push({
			"name": 'bo_colesterol_toma',
			"value": 0
		});
	}
	if ($('#bo_mamografia_realizada_1').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_realizada',
			"value": 1
		});
	} else if ($('#bo_mamografia_realizada_0').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_realizada',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_mamografia_realizada',
			"value": 'NULL'
		});
	}
	if ($('#fc_mamografia').val() == "") {
		parametros.push({
			"name": 'fc_mamografia',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_mamografia',
			"value": "'" + $('#fc_mamografia').val() + "'"
		});
	}
	if ($('#bo_mamografia_vigente_1').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 1
		});
	} else if ($('#bo_mamografia_vigente_0').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 'NULL'
		});
	}
	if ($('#bo_mamografia_toma').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_toma',
			"value": 1
		});
	} else {
		parametros.push({
			"name": 'bo_mamografia_toma',
			"value": 0
		});
	}
	if ($('#bo_mamografia_vigente_1').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 1
		});
	} else if ($('#bo_mamografia_vigente_0').is(':checked')) {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_mamografia_vigente',
			"value": 'NULL'
		});
	}
	$.ajax({
		dataType: "json",
		cache: false,
		async: true,
		data: parametros,
		type: "post",
		url: BASE_URI + "index.php/Empa/guardar",
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