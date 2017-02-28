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
//calculamos circunferencia abdominal
	//Bajo peso
	if (imc < 18.50) {
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

	//enviamos resultados a la caja correspondiente
	$('#gl_imc').val(imc);
	$('#gl_imc').parent().find('span.help-block').html(mensaje);
	$('#gl_imc').parent().find('span.help-block').removeClass("hidden");
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
		$('#btnaudit').hide();
		$('#gl_puntos_audit').hide();
		$('#div_consejeria_alcohol').hide();
	} else {
		$('#btnaudit').show();
		$('#gl_puntos_audit').show();
		$('#div_consejeria_alcohol').show();
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
		$('#lbl_fuma').addClass('hidden');
	} else {
		$('#lbl_fuma').removeClass('hidden');
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
		$('#div_glicemia_agenda').show()
	} else {
		$('#verAgendaDiabetes').hide();
		$('#div_glicemia_agenda').hide()
	}
});

//Si es trabajadora sexual o persona en centro reclusión -> mostrar VDRL y RPR
$(".bo_trabajadora_reclusa").on('change', function (e) {
	if ($('#bo_trabajadora_reclusa_0').is(':checked')) {
		$('#id_vdrl_rpr').addClass('hidden');
	} else {
		$('#id_vdrl_rpr').removeClass('hidden');
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
		$('#tomar_fecha').removeClass('hidden');
		$('#ultimo_pap').addClass('hidden');
	} else {
		$('#tomar_fecha').addClass('hidden');
		$('#ultimo_pap').removeClass('hidden');
	}
});

//PAP Vigente? (automático Calculando si es <=3 años) SI -> Vigente   NO -> No Vigente (Tomar hora para otro)
$("#fc_ultimo_pap").livequery(function () {
	$(this).on('change', function (e) {
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
	});
});
//Si valor colesterlo >= 200 y < 239 (Consejería Alimentaria y Actividad Fisica
//Si valor colesterol >= 240 (Referir a confirmación diagnóstica
$("#gl_colesterol").on('keyup', function (e) {
	var valor_colesterol = $('#gl_colesterol').val();
	if (valor_colesterol > 199 && valor_colesterol < 240) {
		$('#verAgendaDislipidemia').hide();
		$('#div_colesterol').show();
		$('#div_consejeria_colesterol').show();
		$('#gl_colesterol').parent().find('span.help-block').removeClass("hidden");
	} else if (valor_colesterol >= 240) {
		$('#gl_colesterol').parent().find('span.help-block').addClass("hidden");
		$('#div_colesterol').hide();
		$('#div_consejeria_colesterol').hide();
		$('#verAgendaDislipidemia').show();
		$('#div_colesterol_agenda').show();
	} else {
		$('#gl_colesterol').parent().find('span.help-block').addClass("hidden");
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
	});
});

//Si requiere otra Mamografía Mostrar Resultado
$(".bo_mamografia_requiere").on('change', function (e) {

    if ($('#bo_mamografia_requiere').is(':checked')) {
        $('#verAgendaMamografia').hide();
        $('#div_mamografia_agenda').hide();
        $('#mam_resultado2').hide();
        $('#toma_mamografia').hide();
    } else {
        $('#verAgendaMamografia').show();
        $('#div_mamografia_agenda').show();
        $('#mam_resultado2').show();
        $('#toma_mamografia').show();
    }
});

//Boton Guardar AUDIT
$("#guardaraudit").on('click', function (e) {
	$("#gl_puntos_audit").val($("#total").val());
	xModal.close();
});

$(".subTotal").on('change', function (e) {
	
		var total = 0;
		
		//$("#total").val(parseInt(total)+parseInt($(this).val()));
		for(i=1;i<=10;i++){
			total	= total + parseInt($("#puntos_"+i).val());
		}
		
		$("#total").val(total);
	
});


// TODO hacer esto de manera iterativa 1
	$(".radio_audit_1_1").on('click', function (e) {

		if ($(".radio_audit_1_1").is(':checked')) {
			$("#puntos_1").val($(this).val());
			$("#puntos_1").trigger('change');
		}
	});
	$(".radio_audit_2_1").on('click', function (e) {

		if ($(".radio_audit_2_1").is(':checked')) {
			$("#puntos_1").val($(this).val());
			$("#puntos_1").trigger('change');
		}
	});
	$(".radio_audit_3_1").on('click', function (e) {

		if ($(".radio_audit_3_1").is(':checked')) {
			$("#puntos_1").val($(this).val());
			$("#puntos_1").trigger('change');
		}
	});
	$(".radio_audit_4_1").on('click', function (e) {

		if ($(".radio_audit_4_1").is(':checked')) {
			$("#puntos_1").val($(this).val());
			$("#puntos_1").trigger('change');
		}
	});
	$(".radio_audit_5_1").on('click', function (e) {

		if ($(".radio_audit_5_1").is(':checked')) {
			$("#puntos_1").val($(this).val());
			$("#puntos_1").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
// TODO hacer esto de manera iterativa 2
	$(".radio_audit_1_2").on('click', function (e) {

		if ($(".radio_audit_1_2").is(':checked')) {
			$("#puntos_2").val($(this).val());
			$("#puntos_2").trigger('change');

		}
	});
	$(".radio_audit_2_2").on('click', function (e) {

		if ($(".radio_audit_2_2").is(':checked')) {
			$("#puntos_2").val($(this).val());
			$("#puntos_2").trigger('change');

		}
	});
	$(".radio_audit_3_2").on('click', function (e) {

		if ($(".radio_audit_3_2").is(':checked')) {
			$("#puntos_2").val($(this).val());
			$("#puntos_2").trigger('change');
		}
	});
	$(".radio_audit_4_2").on('click', function (e) {

		if ($(".radio_audit_4_2").is(':checked')) {
			$("#puntos_2").val($(this).val());
			$("#puntos_2").trigger('change');
		}
	});
	$(".radio_audit_5_2").on('click', function (e) {

		if ($(".radio_audit_5_2").is(':checked')) {
			$("#puntos_2").val($(this).val());
			$("#puntos_2").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_3").on('click', function (e) {

		if ($(".radio_audit_1_3").is(':checked')) {
			$("#puntos_3").val($(this).val());
			$("#puntos_3").trigger('change');

		}
	});
	$(".radio_audit_2_3").on('click', function (e) {

		if ($(".radio_audit_2_3").is(':checked')) {
			$("#puntos_3").val($(this).val());
			$("#puntos_3").trigger('change');

		}
	});
	$(".radio_audit_3_3").on('click', function (e) {

		if ($(".radio_audit_3_3").is(':checked')) {
			$("#puntos_3").val($(this).val());
			$("#puntos_3").trigger('change');
		}
	});
	$(".radio_audit_4_3").on('click', function (e) {

		if ($(".radio_audit_4_3").is(':checked')) {
			$("#puntos_3").val($(this).val());
			$("#puntos_3").trigger('change');
		}
	});
	$(".radio_audit_5_3").on('click', function (e) {

		if ($(".radio_audit_5_3").is(':checked')) {
			$("#puntos_3").val($(this).val());
			$("#puntos_3").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_4").on('click', function (e) {

		if ($(".radio_audit_1_4").is(':checked')) {
			$("#puntos_4").val($(this).val());
			$("#puntos_4").trigger('change');

		}
	});
	$(".radio_audit_2_4").on('click', function (e) {

		if ($(".radio_audit_2_4").is(':checked')) {
			$("#puntos_4").val($(this).val());
			$("#puntos_4").trigger('change');

		}
	});
	$(".radio_audit_3_4").on('click', function (e) {

		if ($(".radio_audit_3_4").is(':checked')) {
			$("#puntos_4").val($(this).val());
			$("#puntos_4").trigger('change');
		}
	});
	$(".radio_audit_4_4").on('click', function (e) {

		if ($(".radio_audit_4_4").is(':checked')) {
			$("#puntos_4").val($(this).val());
			$("#puntos_4").trigger('change');
		}
	});
	$(".radio_audit_5_4").on('click', function (e) {

		if ($(".radio_audit_5_4").is(':checked')) {
			$("#puntos_4").val($(this).val());
			$("#puntos_4").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_5").on('click', function (e) {

		if ($(".radio_audit_1_5").is(':checked')) {
			$("#puntos_5").val($(this).val());
			$("#puntos_5").trigger('change');

		}
	});
	$(".radio_audit_2_5").on('click', function (e) {

		if ($(".radio_audit_2_5").is(':checked')) {
			$("#puntos_5").val($(this).val());
			$("#puntos_5").trigger('change');

		}
	});
	$(".radio_audit_3_5").on('click', function (e) {

		if ($(".radio_audit_3_5").is(':checked')) {
			$("#puntos_5").val($(this).val());
			$("#puntos_5").trigger('change');
		}
	});
	$(".radio_audit_4_5").on('click', function (e) {

		if ($(".radio_audit_4_5").is(':checked')) {
			$("#puntos_5").val($(this).val());
			$("#puntos_5").trigger('change');
		}
	});
	$(".radio_audit_5_5").on('click', function (e) {

		if ($(".radio_audit_5_5").is(':checked')) {
			$("#puntos_5").val($(this).val());
			$("#puntos_5").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_6").on('click', function (e) {

		if ($(".radio_audit_1_6").is(':checked')) {
			$("#puntos_6").val($(this).val());
			$("#puntos_6").trigger('change');

		}
	});
	$(".radio_audit_2_6").on('click', function (e) {

		if ($(".radio_audit_2_6").is(':checked')) {
			$("#puntos_6").val($(this).val());
			$("#puntos_6").trigger('change');

		}
	});
	$(".radio_audit_3_6").on('click', function (e) {

		if ($(".radio_audit_3_6").is(':checked')) {
			$("#puntos_6").val($(this).val());
			$("#puntos_6").trigger('change');
		}
	});
	$(".radio_audit_4_6").on('click', function (e) {

		if ($(".radio_audit_4_6").is(':checked')) {
			$("#puntos_6").val($(this).val());
			$("#puntos_6").trigger('change');
		}
	});
	$(".radio_audit_5_6").on('click', function (e) {

		if ($(".radio_audit_5_6").is(':checked')) {
			$("#puntos_6").val($(this).val());
			$("#puntos_6").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_7").on('click', function (e) {

		if ($(".radio_audit_1_7").is(':checked')) {
			$("#puntos_7").val($(this).val());
			$("#puntos_7").trigger('change');

		}
	});
	$(".radio_audit_2_7").on('click', function (e) {

		if ($(".radio_audit_2_").is(':checked')) {
			$("#puntos_7").val($(this).val());
			$("#puntos_7").trigger('change');

		}
	});
	$(".radio_audit_3_7").on('click', function (e) {

		if ($(".radio_audit_3_7").is(':checked')) {
			$("#puntos_7").val($(this).val());
			$("#puntos_7").trigger('change');
		}
	});
	$(".radio_audit_4_7").on('click', function (e) {

		if ($(".radio_audit_4_7").is(':checked')) {
			$("#puntos_7").val($(this).val());
			$("#puntos_7").trigger('change');
		}
	});
	$(".radio_audit_5_7").on('click', function (e) {

		if ($(".radio_audit_5_7").is(':checked')) {
			$("#puntos_7").val($(this).val());
			$("#puntos_7").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_8").on('click', function (e) {

		if ($(".radio_audit_1_8").is(':checked')) {
			$("#puntos_8").val($(this).val());
			$("#puntos_8").trigger('change');

		}
	});
	$(".radio_audit_2_8").on('click', function (e) {

		if ($(".radio_audit_2_8").is(':checked')) {
			$("#puntos_8").val($(this).val());
			$("#puntos_8").trigger('change');

		}
	});
	$(".radio_audit_3_8").on('click', function (e) {

		if ($(".radio_audit_3_8").is(':checked')) {
			$("#puntos_8").val($(this).val());
			$("#puntos_8").trigger('change');
		}
	});
	$(".radio_audit_4_8").on('click', function (e) {

		if ($(".radio_audit_4_8").is(':checked')) {
			$("#puntos_8").val($(this).val());
			$("#puntos_8").trigger('change');
		}
	});
	$(".radio_audit_5_8").on('click', function (e) {

		if ($(".radio_audit_5_8").is(':checked')) {
			$("#puntos_8").val($(this).val());
			$("#puntos_8").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_9").on('click', function (e) {

		if ($(".radio_audit_1_9").is(':checked')) {
			$("#puntos_9").val($(this).val());
			$("#puntos_9").trigger('change');

		}
	});
	$(".radio_audit_2_9").on('click', function (e) {

		if ($(".radio_audit_2_9").is(':checked')) {
			$("#puntos_9").val($(this).val());
			$("#puntos_9").trigger('change');

		}
	});
	$(".radio_audit_3_9").on('click', function (e) {

		if ($(".radio_audit_3_9").is(':checked')) {
			$("#puntos_9").val($(this).val());
			$("#puntos_9").trigger('change');
		}
	});
	$(".radio_audit_4_9").on('click', function (e) {

		if ($(".radio_audit_4_9").is(':checked')) {
			$("#puntos_9").val($(this).val());
			$("#puntos_9").trigger('change');
		}
	});
	$(".radio_audit_5_9").on('click', function (e) {

		if ($(".radio_audit_5_9").is(':checked')) {
			$("#puntos_9").val($(this).val());
			$("#puntos_9").trigger('change');
		}
	});
////////////////////////////////////////////////////////////////
//// TODO hacer esto de manera iterativa
	$(".radio_audit_1_10").on('click', function (e) {

		if ($(".radio_audit_1_10").is(':checked')) {
			$("#puntos_10").val($(this).val());
			$("#puntos_10").trigger('change');

		}
	});
	$(".radio_audit_2_10").on('click', function (e) {

		if ($(".radio_audit_2_10").is(':checked')) {
			$("#puntos_10").val($(this).val());
			$("#puntos_10").trigger('change');

		}
	});
	$(".radio_audit_3_10").on('click', function (e) {

		if ($(".radio_audit_3_10").is(':checked')) {
			$("#puntos_10").val($(this).val());
			$("#puntos_10").trigger('change');
		}
	});
	$(".radio_audit_4_10").on('click', function (e) {

		if ($(".radio_audit_4_10").is(':checked')) {
			$("#puntos_10").val($(this).val());
			$("#puntos_10").trigger('change');
		}
	});
	$(".radio_audit_5_10").on('click', function (e) {

		if ($(".radio_audit_5_10").is(':checked')) {
			$("#puntos_10").val($(this).val());
			$("#puntos_10").trigger('change');
		}
	});
	
////////////////////////////////////////////////////////////////

//Boton Guardar EMPA
$("#guardar").on('click', function (e) {
        var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();
                        
                        if($('#bo_consume_alcohol_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_consume_alcohol',
					"value" : 1
				});
			}else if($('#bo_consume_alcohol_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_consume_alcohol',
					"value" : 0
				});
			}else{
                                parametros.push({
                                            "name"  : 'bo_consume_alcohol',
                                            "value" : 'NULL'
                                    });
                        }
                        if($('#gl_puntos_audit').val() == ""){
				parametros.push({
					"name"  : 'gl_puntos_audit',
					"value" : 'NULL'
				});
			}
			if($('#bo_fuma_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_fuma',
					"value" : 1
				});
			}else if ($('#bo_fuma_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_fuma',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_fuma',
					"value" : 'NULL'
				});
                        }
                        if($('#gl_peso').val() == ""){
				parametros.push({
					"name"  : 'gl_peso',
					"value" : ""
				});
			}
                        if($('#id_clasificacion_imc').val() == ""){
				parametros.push({
					"name"  : 'id_clasificacion_imc',
					"value" : 'NULL'
				});
			}
                        if($('#gl_estatura').val() == ""){
				parametros.push({
					"name"  : 'gl_estatura',
					"value" : ""
				});
			}
                        if($('#gl_circunferencia_abdominal').val() == ""){
				parametros.push({
					"name"  : 'gl_circunferencia_abdominal',
					"value" : ""
				});
			}
                        if($('#gl_imc').val() == ""){
				parametros.push({
					"name"  : 'gl_imc',
					"value" : ""
				});
			}
                        if($('#nr_ficha').val() == ""){
				parametros.push({
					"name"  : 'nr_ficha',
					"value" : 'NULL'
				});
			}
                        if($('#id_sector').val() == ""){
				parametros.push({
					"name"  : 'id_sector',
					"value" : 'NULL'
				});
			}
                        if($('#gl_pad').val() == ""){
				parametros.push({
					"name"  : 'gl_pad',
					"value" : ""
				});
			}
                        if($('#gl_pas').val() == ""){
				parametros.push({
					"name"  : 'gl_pas',
					"value" : ""
				});
			}
                        if($('#gl_glicemia').val() == ""){
				parametros.push({
					"name"  : 'gl_glicemia',
					"value" : ""
				});
			}
                        if($('#bo_pap_toma_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_toma',
					"value" : 1
				});
			}else if ($('#bo_pap_toma_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_toma',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_pap_toma',
					"value" : 'NULL'
				});
                        }
                        if($('#fc_ultimo_pap').val() == ""){
				parametros.push({
					"name"  : 'fc_ultimo_pap',
					"value" : 'NULL'
				});
			} else {
                            parametros.push({
					"name"  : 'fc_ultimo_pap',
					"value" : "'"+$('#fc_ultimo_pap').val()+"'"
				});
                        }
                        if($('#gl_colesterol').val() == ""){
				parametros.push({
					"name"  : 'gl_colesterol',
					"value" : ""
				});
			}
                        if($('#gl_observaciones_empa').val() == ""){
				parametros.push({
					"name"  : 'gl_observaciones_empa',
					"value" : ""
				});
			}
			if($('#bo_glicemia_toma').is(':checked')){
				parametros.push({
					"name"  : 'bo_glicemia_toma',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'bo_glicemia_toma',
					"value" : 0
				});
			}
                        if($('#bo_trabajadora_reclusa_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_trabajadora_reclusa',
					"value" : 1
				});
			}else if ($('#bo_trabajadora_reclusa_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_trabajadora_reclusa',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_trabajadora_reclusa',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_vdrl_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_vdrl',
					"value" : 1
				});
			}else if ($('#bo_vdrl_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_vdrl',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_vdrl',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_rpr_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_rpr',
					"value" : 1
				});
			}else if ($('#bo_rpr_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_rpr',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_rpr',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_tos_productiva_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_tos_productiva',
					"value" : 1
				});
			}else if ($('#bo_tos_productiva_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_tos_productiva',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_tos_productiva',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_baciloscopia_toma_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_baciloscopia_toma',
					"value" : 1
				});
			}else if ($('#bo_baciloscopia_toma_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_baciloscopia_toma',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_baciloscopia_toma',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_pap_realizado_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_realizado',
					"value" : 1
				});
			}else if ($('#bo_pap_realizado_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_realizado',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_pap_realizado',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_pap_vigente_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_vigente',
					"value" : 1
				});
			}else if ($('#bo_pap_vigente_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_pap_vigente',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_pap_vigente',
					"value" : 'NULL'
				});
                        }
                        if($('#fc_tomar_pap').val() == ""){
				parametros.push({
					"name"  : 'fc_tomar_pap',
					"value" : 'NULL'
				});
                        } else {
                            parametros.push({
					"name"  : 'fc_tomar_pap',
					"value" : "'"+$('#fc_tomar_pap').val()+"'"
				});
                        }
                        if($('#bo_colesterol_toma').is(':checked')){
				parametros.push({
					"name"  : 'bo_colesterol_toma',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'bo_colesterol_toma',
					"value" : 0
				});
			}
                        if($('#bo_mamografia_realizada_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_realizada',
					"value" : 1
				});
			}else if ($('#bo_mamografia_realizada_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_realizada',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_mamografia_realizada',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_mamografia_vigente_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 1
				});
			}else if ($('#bo_mamografia_vigente_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 'NULL'
				});
                        }
                        if($('#bo_mamografia_toma').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_toma',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'bo_mamografia_toma',
					"value" : 0
				});
			}
                        if($('#bo_mamografia_vigente_1').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 1
				});
			}else if ($('#bo_mamografia_vigente_0').is(':checked')){
				parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 0
				});
			}else{
                                parametros.push({
					"name"  : 'bo_mamografia_vigente',
					"value" : 'NULL'
				});
                        }
			$.ajax({
				dataType:   "json",
				cache	:   false,
				async	:   true,
				data	:   parametros,
				type	:   "post",
				url	:   BASE_URI + "index.php/Empa/guardar", 
				error	:   function(xhr, textStatus, errorThrown){
							xModal.danger('Error: No se pudo Ingresar un nuevo Registro');
				},
				success	:   function(data){
							if(data.correcto){
								xModal.success('Éxito: Se Ingresó nuevo Registro!');
							} else {
								xModal.info('Error: No se pudo Ingresar un nuevo Registro');
							}
				}
			});
		buttonEndProcess(button_process);
});