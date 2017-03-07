//Cuando Carga FORM
$("#form").ready(function () {
    var imc = $('#gl_imc').val();
    var pts_audit = $('#gl_puntos_audit').val();
    //funcion mensaje span IMC
    mensajeIMC(imc);
    //funcion mensaje span Puntos AUDIT
    mensajeAUDIT(pts_audit);
    
	if($("#ultimo_pap_ano").val()){
		$("#fc_ultimo_pap_ano option[value="+ $("#ultimo_pap_ano").val() +"]").attr("selected",true);
	}
	if($("#ultimo_pap_mes").val()){
		$("#fc_ultimo_pap_mes option[value="+ $("#ultimo_pap_mes").val() +"]").attr("selected",true);
	}
	if($("#mamografia_ano").val()){
		$("#fc_mamografia_ano option[value="+ $("#mamografia_ano").val() +"]").attr("selected",true);
	}
	if($("#mamografia_mes").val()){
		$("#fc_mamografia_mes option[value="+ $("#mamografia_mes").val() +"]").attr("selected",true);
	}
	
    if ($("#bo_mamografia_toma").is(':checked')){
        $("#bo_mamografia_requiere_1").prop('checked', true);
    }
	
});

//Poner Mensaje en span segun Puntos de AUDIT
function mensajeAUDIT(pts_audit){
	var parametros = {'pts_audit': pts_audit};
    if (parametros['pts_audit'] !== '') {
        $.ajax({
            dataType: "json",
            cache: false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Empa/mensajeAUDIT",
            error: function (xhr, textStatus, errorThrown) {
            },
            success: function (data) {
                if (data.correcto) {
                    $('#gl_puntos_audit').css("borderColor", "");
                    $('#gl_puntos_audit').parent().find("span.help-block").css("color", "");
                    $('#gl_puntos_audit').css("borderColor", data.gl_color);
                    $('#gl_puntos_audit').parent().find("span.help-block").css("color", "'" + data.gl_color + "'");
                    $('#gl_puntos_audit').parent().find('span.help-block').html(data.gl_mensaje);
                    $('#gl_puntos_audit').parent().find('span.help-block').removeClass("hidden");
                    $('#id_clasificacion_audit').val(data.id_tipo_audit);
                } else {
                    xModal.info('Error!');
                }
            }
        });
    }
	/*  var mensaje = "";
    if (pts_audit != "") {
        if (pts_audit >= 0 && pts_audit <= 7) {
            $('#gl_puntos_audit').css("borderColor", "");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "");
            $('#gl_puntos_audit').parent().removeClass("has-error");
            $('#gl_puntos_audit').parent().addClass("has-success");
            mensaje = "Bajo Riesgo";
        } else if (pts_audit >= 8 && pts_audit <= 15) {
            $('#gl_puntos_audit').css("borderColor", "");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "");
            $('#gl_puntos_audit').parent().removeClass("has-error");
            $('#gl_puntos_audit').parent().removeClass("has-success");
            $('#gl_puntos_audit').css("borderColor", "#BDB76B");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "#BDB76B");
            mensaje = "Riesgo";
        } else if (pts_audit >= 16 && pts_audit <= 19) {
            $('#gl_puntos_audit').css("borderColor", "");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "");
            $('#gl_puntos_audit').parent().removeClass("has-error");
            $('#gl_puntos_audit').parent().removeClass("has-success");
            $('#gl_puntos_audit').css("borderColor", "#FF8C00");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "#FF8C00");
            mensaje = "Problema";
        } else if (pts_audit >= 20 && pts_audit <= 40) {
            $('#gl_puntos_audit').css("borderColor", "");
            $('#gl_puntos_audit').parent().find("span.help-block").css("color", "");
            $('#gl_puntos_audit').parent().removeClass("has-success");
            $('#gl_puntos_audit').parent().addClass("has-error");
            mensaje = "Problema o Dependencia";
        }
    }
    $('#gl_puntos_audit').parent().find('span.help-block').html(mensaje);
    $('#gl_puntos_audit').parent().find('span.help-block').removeClass("hidden");*/
}


//Poner Mensaje en span segun IMC
function mensajeIMC(imc) {
    var parametros = {'imc': imc};
    if (parametros['imc'] != '') {
        $.ajax({
            dataType: "json",
            cache: false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Empa/mensajeIMC",
            error: function (xhr, textStatus, errorThrown) {
            },
            success: function (data) {
                if (data.correcto) {
                    $('#gl_imc').css("borderColor", "");
                    $('#gl_imc').parent().find("span.help-block").css("color", "");
                    $('#gl_imc').css("borderColor", data.gl_color);
                    $('#gl_imc').parent().find("span.help-block").css("color", "'" + data.gl_color + "'");
                    $('#gl_imc').parent().find('span.help-block').html(data.gl_mensaje);
                    $('#gl_imc').parent().find('span.help-block').removeClass("hidden");
                    $('#id_clasificacion_imc').val(data.id_tipo_imc);
                } else {
                    xModal.info('Error!');
                }
            }
        });
    }
}

//Calcular IMC segun Peso y Altura
function calculaIMC()
{
//hacemos la llamada a los datos introducidos
	var peso = $('#gl_peso').val();
	var altura = $('#gl_estatura').val() / 100;
//calculamos el imc
	var imc = peso / (altura * altura);
	imc = imc.toFixed(2);

	//mensaje si no tiene valores y dar valor="" a gl_imc
	if ((peso == "") || (altura == "")) {
		xModal.danger("Ingrese Peso y Altura");
		imc = "";
                $('#gl_imc').css("borderColor", "");
                $('#gl_imc').parent().find("span.help-block").css("color", "");
                $('#gl_imc').parent().find('span.help-block').addClass("hidden");
                $('#gl_peso').focus();
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
		$('#botonayudaCAbdominal88').show();
	} else {
		$('#botonayudaCAbdominal88').hide();
	}
});

// Si Consume Alcohol muestra Boton para Hacer Cuestionario AUDIT
$(".bo_consume_alcohol").on('change', function (e) {
	if ($('#bo_consume_alcohol_0').is(':checked')) {
		$('#div_alcoholismo1').hide();
                $('#div_alcoholismo2').hide();
	} else {
		$('#div_alcoholismo1').show();
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
                $('#group_glicemia').hide();
	} else {
		$('#glicemia').show();
                $('#group_glicemia').show();
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
		$('#id_vdrl').hide();
                $('#id_rpr').hide();
	} else {
		$('#id_vdrl').show();
                $('#id_rpr').show();
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

$(".bo_vih").on('change', function (e) {

	if ((!$('#bo_vih_1').is(':checked'))) {
		$('#verAgendaVIH').hide();
		$('#div_vih_agenda').hide();
	} else {
		$('#verAgendaVIH').show();
		$('#div_vih_agenda').show();
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
$("#fc_ultimo_pap_ano").on('change', function (e) {
        if ($("#fc_ultimo_pap_ano").val() == 0 || $("#fc_ultimo_pap_mes").val() == 0) {
            $('#bo_pap_vigente_1').prop('checked', false);
            $('#bo_pap_vigente_0').prop('checked', false);
        } else {
			var fecha = $("#fc_ultimo_pap_ano").val()+"-"+$("#fc_ultimo_pap_mes").val()+"-"+01;
            var edad = calcularYear(fecha);
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
$("#fc_ultimo_pap_mes").on('change', function (e) {
        if ($("#fc_ultimo_pap_ano").val() == 0 || $("#fc_ultimo_pap_mes").val() == 0) {
            $('#bo_pap_vigente_1').prop('checked', false);
            $('#bo_pap_vigente_0').prop('checked', false);
        } else {
			var fecha = $("#fc_ultimo_pap_ano").val()+"-"+$("#fc_ultimo_pap_mes").val()+"-"+01;
            var edad = calcularYear(fecha);
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
$("#fc_mamografia_ano").on('change', function (e) {
	if ($("#fc_mamografia_ano").val() == 0 || $("#fc_mamografia_mes").val() == 0) {
		$('#bo_mamografia_vigente_1').prop('checked', false);
		$('#bo_mamografia_vigente_0').prop('checked', false);
	} else {
		var fecha = $("#fc_mamografia_ano").val()+"-"+$("#fc_mamografia_mes").val()+"-"+01;
        var edad = calcularYear(fecha);
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
$("#fc_mamografia_mes").on('change', function (e) {
	if ($("#fc_mamografia_ano").val() == 0 || $("#fc_mamografia_mes").val() == 0) {
		$('#bo_mamografia_vigente_1').prop('checked', false);
		$('#bo_mamografia_vigente_0').prop('checked', false);
	} else {
		var fecha = $("#fc_mamografia_ano").val()+"-"+$("#fc_mamografia_mes").val()+"-"+01;
        var edad = calcularYear(fecha);
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

//Si requiere otra Mamografía Mostrar Resultado
$(".bo_mamografia_requiere").on('change', function (e) {

	if ($('#bo_mamografia_requiere_0').is(':checked')) {
		$('#mam_resultado2').hide();
		$('#requiere_mamografia').hide();
                $('#requiere_mamografia2').hide();
	} else {
		$('#mam_resultado2').show();
		$('#requiere_mamografia').show();
                $('#requiere_mamografia2').show();
	}
});

//Boton Guardar AUDIT
$("#guardaraudit").livequery(function () {
	$(this).on('click', function (e) {
		var button_process = buttonStartProcess($(this), e);
		var id_empa = $('#id_empa').val();
		var cant_pre = $('#cant_pre').val();
		var parametros = $("#formAudit").serializeArray();
		parametros.push({
			"name": 'id_empa',
			"value": id_empa
		});
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
			url: BASE_URI + "index.php/Empa/guardarAudit",
			error: function (xhr, textStatus, errorThrown) {
				xModal.danger('Error: No se pudo Ingresar AUDIT');
			},
			success: function (data) {
				if (data.correcto) {
					xModal.success('Éxito: Se Ingresó nuevo AUDIT!');
				} else {
					xModal.info('Error: No se pudo Ingresar AUDIT');
				}
			}
		});
		buttonEndProcess(button_process);
		$("#gl_puntos_audit").val($("#total").val());
                //Según tipo de consumo mostrar Mensaje (de acuerdo a puntos del AUDIT)
                $("#div_alcoholismo2").show();
                var pts_audit = $('#gl_puntos_audit').val();
                mensajeAUDIT(pts_audit);
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
		var i = 0;
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
			"value": 'NULL'
		});
	} else {
                parametros.push({
                    "name": 'gl_peso',
                    "value": "'" + $('#gl_peso').val() + "'"
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
			"value": 'NULL'
		});
	} else {
                parametros.push({
                    "name": 'gl_estatura',
                    "value": "'" + $('#gl_estatura').val() + "'"
                });
        }
	if ($('#gl_circunferencia_abdominal').val() == "") {
		parametros.push({
			"name": 'gl_circunferencia_abdominal',
			"value": 'NULL'
		});
	} else {
                parametros.push({
                    "name": 'gl_circunferencia_abdominal',
                    "value": "'" + $('#gl_circunferencia_abdominal').val() + "'"
                });
        }
	if ($('#gl_imc').val() == "") {
		parametros.push({
			"name": 'gl_imc',
			"value": 'NULL'
		});
	} else {
                parametros.push({
                    "name": 'gl_imc',
                    "value": "'" + $('#gl_imc').val() + "'"
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
			"value": 'NULL'
		});
	} else {
                parametros.push({
			"name": 'gl_pad',
			"value": "'" + $('#gl_pad').val() + "'"
		});
        }
	if ($('#gl_pas').val() == "") {
		parametros.push({
			"name": 'gl_pas',
			"value": 'NULL'
		});
	} else {
                parametros.push({
			"name": 'gl_pas',
			"value": "'" + $('#gl_pas').val() + "'"
		});
        }
	if ($('#gl_glicemia').val() == "") {
		parametros.push({
			"name": 'gl_glicemia',
			"value": 'NULL'
		});
	} else {
                parametros.push({
			"name": 'gl_glicemia',
			"value": "'" + $('#gl_glicemia').val() + "'"
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
	if ($('#fc_ultimo_pap_ano').val() == "") {
		parametros.push({
			"name": 'fc_ultimo_pap_ano',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_ultimo_pap_ano',
			"value": $('#fc_ultimo_pap_ano').val()
		});
	}
	if ($('#fc_ultimo_pap_mes').val() == "") {
		parametros.push({
			"name": 'fc_ultimo_pap_mes',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_ultimo_pap_mes',
			"value": "'" + $('#fc_ultimo_pap_mes').val() + "'"
		});
	}
	if ($('#gl_colesterol').val() == "") {
		parametros.push({
			"name": 'gl_colesterol',
			"value": 'NULL'
		});
	} else {
                parametros.push({
                        "name": 'gl_colesterol',
                        "value": "'" + $('#gl_colesterol').val() + "'"
                });
        }
	if ($('#gl_observaciones_empa').val() == "") {
		parametros.push({
			"name": 'gl_observaciones_empa',
			"value": 'NULL'
		});
	} else {
                parametros.push({
                        "name": 'gl_observaciones_empa',
                        "value": "'" + $('#gl_observaciones_empa').val() + "'"
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
			"value": 'NULL'
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
	if ($('#bo_vih_1').is(':checked')) {
		parametros.push({
			"name": 'bo_vih',
			"value": 1
		});
	} else if ($('#bo_vih_0').is(':checked')) {
		parametros.push({
			"name": 'bo_vih',
			"value": 0
		});
	} else {
		parametros.push({
			"name": 'bo_vih',
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
			"value": 'NULL'
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
        if ($('#fc_empa').val() == "") {
		parametros.push({
			"name": 'fc_empa',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_empa',
			"value": "'" + $('#fc_empa').val() + "'"
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
	if ($('#fc_mamografia_ano').val() == "") {
		parametros.push({
			"name": 'fc_mamografia_ano',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_mamografia_ano',
			"value": $('#fc_mamografia_ano').val()
		});
	}
	if ($('#fc_mamografia_mes').val() == "") {
		parametros.push({
			"name": 'fc_mamografia_mes',
			"value": 'NULL'
		});
	} else {
		parametros.push({
			"name": 'fc_mamografia_mes',
			"value": "'" + $('#fc_mamografia_mes').val() + "'"
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
			"value": 'NULL'
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