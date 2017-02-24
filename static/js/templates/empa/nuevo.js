//Calcular IMC segun Peso y Altura
function calculaIMC()
{
//hacemos la llamada a los datos introducidos
    var peso = $('#gl_peso').val();
    var altura = $('#gl_estatura').val()/100;
    var mensaje = "";
//calculamos el imc
    var imc = peso / (altura * altura);
    imc = imc.toFixed(2);
//calculamos circunferencia abdominal
    //Bajo peso
    if (imc < 18.50){
        if (imc < 16.00){
            mensaje = "Bajo Peso / Delgadez Severa";
        }
        if (imc >= 16.00 && imc < 17.00){
            mensaje = "Bajo Peso / Delgadez Moderada";
        }
        if (imc >= 17.00 && imc < 18.50){
            mensaje = "Bajo Peso / Delgadez Aceptable";
        }
    }
    //Peso Normal
    if (imc >= 18.50 && imc <= 24.99){
            mensaje = "Peso Normal";
    }
    //Sobre Peso
    if (imc >= 25.00 && imc < 30.00){
            mensaje = "Sobrepeso / Pre Obeso (riesgo)";
    }
    //Obeso
    if (imc >= 30.00){
        if (imc >= 30.00 && imc < 35.00){
            mensaje = "Obeso / Obeso Tipo I (riesgo moderado)";
        }
        if (imc >= 35.00 && imc < 40.00){
            mensaje = "Obeso / Obeso Tipo II (riesgo severo)";
        }
        if (imc >= 40.00){
            mensaje = "Obeso / Obeso Tipo III (riesgo muy severo)";
        }
    }
    alert(imc+mensaje);
//enviamos resultados a la caja correspondiente
    $('#gl_imc').val(imc);
    $('#gl_imc').parent().find('span.help-block').html(mensaje);
    $('#gl_imc').parent().find('span.help-block').removeClass("hidden");
} 
//Si Circunferencia Abdominal es mayor o igual a 88cm -> Consejería
$("#gl_circunferencia_abdominal").on('blur', function (e) {
    if ($("#gl_circunferencia_abdominal").val() >= 88){
        $('#gl_circunferencia_abdominal').parent().find('span.help-block').html("Mayor/Igual a 90 (Consejería Alimentación Sana y Actividad Física)");
        $('#gl_circunferencia_abdominal').parent().find('span.help-block').removeClass("hidden");
    }else{
        $('#gl_circunferencia_abdominal').parent().find('span.help-block').addClass("hidden");
    }
});

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

//Según tipo de consumo mostrar Consejería AUDIT
$("#gl_puntos_audit").on('change', function (e) {
    if ($('#gl_puntos_audit').val() > 0) {

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
$("#gl_pas").on('keyup', function (e) {
    if ($("#gl_pas").val() >= 140){
        $('#gl_pas').parent().find('span.help-block').html("Mayor/Igual a 140 Referir a...");
        $('#gl_pas').parent().find('span.help-block').removeClass("hidden");
    }else{
        $('#gl_pas').parent().find('span.help-block').addClass("hidden");
    }
});
$("#gl_pad").on('keyup', function (e) {
    if ($("#gl_pad").val() >= 90){
        $('#gl_pad').parent().find('span.help-block').html("Mayor/Igual a 90 Referir a...");
        $('#gl_pad').parent().find('span.help-block').removeClass("hidden");
    }else{
        $('#gl_pad').parent().find('span.help-block').addClass("hidden");
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
        $('#gl_glicemia').parent().find('span.help-block').html("Referir Agenda Profesional");
        $('#gl_glicemia').parent().find('span.help-block').removeClass("hidden");
    } else {
        $('#gl_glicemia').parent().find('span.help-block').addClass("hidden");
    }
});

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
        $('#lbl_its1').hide();
    } else {
        $('#lbl_its1').show();
    }
});
$(".bo_vdrl").on('change', function (e) {
    if ($('#bo_vdrl').is(':checked')) {
        $('#lbl_its2').hide();
    } else {
        $('#lbl_its2').show();
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