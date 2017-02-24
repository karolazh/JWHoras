
// Si Consume Alcohol muestra Boton para Hacer Cuestionario AUDIT
$(".bo_consume_alcohol").on('change', function (e) {
    if ($('#bo_consume_alcohol').is(':checked')) {
        $('#btnaudit').addClass('hidden');
        $('#gl_puntos_audit').addClass('hidden');
    } else {
        $('#btnaudit').removeClass('hidden');
        $('#gl_puntos_audit').removeClass('hidden');
    }
});

//Según tipo de consumo mostrar Consejería
$("#gl_puntos_audit").on('change', function (e) {
    if ($('#bo_consume_alcohol').val() > 0) {

    } else {

    }
});

//Si Fuma muestra Consejería
$(".bo_fuma").on('change', function (e) {
    if ($('#bo_fuma').is(':checked')) {
        $('#lbl_fuma').addClass('hidden');
    } else {
        $('#lbl_fuma').removeClass('hidden');
    }
});

//Si PAS es >= 140 o PAD >= 90 Activar Funcionalidad de Agenda de Profesional



//(Si Examen de Glicemia es = 100-125 mh/dl consejería alimentacion) (Si valor >= 126 Referir confirmación diagnóstica)



//Si es trabajadora sexual o persona en centro reclusión -> mostrar VDRL y RPR
$(".bo_trabajadora_reclusa").on('change', function (e) {
    if ($('#bo_trabajadora_reclusa').is(':checked')) {
        $('#id_vdrl_rpr').addClass('hidden');
    } else {
        $('#id_vdrl_rpr').removeClass('hidden');
    }
});

//Si VDRL o RPR es positivo -> Activar Funcionalidad de Agenda para ITS
$(".bo_rpr").on('change', function (e) {
    if ($('#bo_rpr').is(':checked')) {
        $('#lbl_its').addClass('hidden');
    } else {
        $('#lbl_its').removeClass('hidden');
    }
});
$(".bo_vdrl").on('change', function (e) {
    if ($('#bo_vdrl').is(':checked')) {
        $('#lbl_its').addClass('hidden');
    } else {
        $('#lbl_its').removeClass('hidden');
    }
});

//Si ha tenido Tos por + 15 dias -> mostrar Baciloscopia
$(".bo_tos_productiva").on('change', function (e) {
    if ($('#bo_tos_productiva').is(':checked')) {
        $('#id_baciloscopia').addClass('hidden');
    } else {
        $('#id_baciloscopia').removeClass('hidden');
    }
});

//Se ha realizado PAP? Si -> Muestra ultima fecha ; No -> Muestra Input para tomar fecha
$(".bo_pap_realizado").on('change', function (e) {
    if ($('#bo_pap_realizado').is(':checked')) {
        $('#tomar_fecha').removeClass('hidden');
        $('#ultimo_pap').addClass('hidden');
    } else {
        $('#tomar_fecha').addClass('hidden');
        $('#ultimo_pap').removeClass('hidden');
    }
});

//PAP Vigente? (automático Calculando si es <=3 años) SI -> Vigente   NO -> No Vigente (Tomar hora para otro)
$("#fc_ultimo_pap").livequery(function(){
	$(this).on('change', function(e) {
		var edad = calcularYear($(this).val());
		if(edad<=3){
			//check Si
			$('#bo_pap_vigente_1').prop('checked',true);
		}else{
			//check No
			$('#bo_pap_vigente_0').prop('checked',true);
		}
		$('#pap_vigente').show();
	});
});
//

//Si realizo Examen Cancer de mama Mostrar -> Ingrese Fecha
$(".bo_mamografia_realizada").on('change', function (e) {
    if ($('#bo_mamografia_realizada').is(':checked')) {
        $('#fecha_mamografia').hide();
    } else {
        $('#fecha_mamografia').show();
    }
});

//Examen Cancer de mama vigente?
$("#fc_mamografia").livequery(function(){
	$(this).on('change', function(e) {
		var edad = calcularYear($(this).val());
		if(edad<=1){
			//check Si
			$('#bo_mamografia_vigente_1').prop('checked',true);
		}else{
			//check No
			$('#bo_mamografia_vigente_0').prop('checked',true);
		}
		$('#mam_vigente').show();
		$('#mam_resultado').show();
		$('#mam_requiere').show();
	});
});

//Si requiere otra Mamografía Mostrar Resultado
$(".bo_mamografia_requiere").on('change', function (e) {
    if ($('#bo_mamografia_requiere').is(':checked')) {
        $('#mam_resultado2').hide();
    } else {
        $('#mam_resultado2').show();
    }
});