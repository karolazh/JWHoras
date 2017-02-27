/* global BASE_URI */

    $("#guardar").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();
        var gl_rut			= $("#rut").val();

		if(gl_rut == ''){
			xModal.danger('- El campo RUT es Obligatorio');
		}else{
			if($('#chkextranjero').is(':checked')){
				parametros.push({
					"name"  : 'chkextranjero',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'chkextranjero',
					"value" : 0
				});
			}
			if($('#chkAcepta').is(':checked')){
				parametros.push({
					"name"  : 'chkAcepta',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'chkAcepta',
					"value" : 0
				});
			}
			if($('#chkReconoce').is(':checked')){
				parametros.push({
					"name"  : 'chkReconoce',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'chkReconoce',
					"value" : 0
				});
			}

			$.ajax({
				dataType: "json",
				cache	:false,
				async	: true,
				data	: parametros,
				type	: "post",
				url		: BASE_URI + "index.php/Registro/GuardarRegistro", 
				error	: function(xhr, textStatus, errorThrown){
							xModal.danger('Error: No se pudo Ingresar un nuevo Registro');
				},
				success	: function(data){
							if(data.correcto){
								xModal.success('Éxito: Se Ingresó nuevo Registro!');
								location.href = BASE_URI + "index.php/Registro";
							} else {
								xModal.info('Error: No se pudo Ingresar un nuevo Registro');
							}
				}
			});
		}
		buttonEndProcess(button_process);
		
    });

    $("#guardarMotivo").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();

			if($('#chkAcepta').is(':checked') && !$('#chkAcepta').is(':disabled')){
				parametros.push({
					"name"  : 'chkAcepta',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'chkAcepta',
					"value" : 0
				});
			}
			if($('#chkReconoce').is(':checked') && !$('#chkReconoce').is(':disabled')){
				parametros.push({
					"name"  : 'chkReconoce',
					"value" : 1
				});
			}else{
				parametros.push({
					"name"  : 'chkReconoce',
					"value" : 0
				});
			}

			$.ajax({
				dataType: "json",
				cache	:false,
				async	: true,
				data	: parametros,
				type	: "post",
				url		: BASE_URI + "index.php/Registro/GuardarMotivo", 
				error	: function(xhr, textStatus, errorThrown){
							xModal.danger('Error: No se pudo Ingresar un nuevo Motivo de Consulta');
				},
				success	: function(data){
							if(data.correcto){
								xModal.success('Éxito: Se Ingresó nuevo Motivo de Consulta!');
								location.href = BASE_URI + "index.php/Registro";
							} else {
								xModal.info('Error: No se pudo Ingresar un nuevo Motivo de Consulta');
							}
				}
			});
		buttonEndProcess(button_process);
    });

    $("#chkextranjero").on('click', function(e) {		
		if($('#chkextranjero').is(':checked')){
			$("#div_rut").hide();
			$("#extranjero").show();
		}else{
			$("#extranjero").hide();
			$("#div_rut").show();
		}
    });
	
	//Formatea Fecha
	function formattedDate(date) {
		var d		= new Date(date || Date.now()),
			day		= '' + d.getDate(),
			month	= '' + (d.getMonth() + 1),
			year	= d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [day, month, year].join('/');
	}

	var Registro = {
		cargarRegistro : function(){
			var rut = $("#rut").val();
			if(rut != ""){
				$.ajax({
					dataType: "json",
					cache	:false,
					async	: true,
					data	: {rut:rut},
					type	: "post",
					url		: BASE_URI + "index.php/Registro/cargarRegistro", 
					error	: function(xhr, textStatus, errorThrown){
								xModal.danger('Error al Buscar');
					},
					success	: function(data){
								if(data.correcto){
									xModal.success('Paciente ya Registro.<br>Se procede a cargar la información.');
									$("#id_registro").val(data.id_registro);
									$("#nombres").val(data.gl_nombres);
									$("#apellidos").val(data.gl_apellidos);
									$("#fc_nacimiento").val(data.fc_nacimiento);
									$("#fc_nacimiento").trigger('blur');
									$("#prevision").val(data.id_prevision);
									$("#direccion").val(data.gl_direccion);
									$("#region").val(data.id_region);									
									$("#gl_latitud").val(data.gl_latitud);
									$("#gl_longitud").val(data.gl_longitud);
									$("#gl_longitud").trigger('change');

									$("#fono").val(data.gl_fono);
									$("#celular").val(data.gl_celular);
									$("#email").val(data.gl_email);
									
									if(data.id_comuna != '0'){
										var comuna = '<option value="'+data.id_comuna+'">'+data.gl_nombre_comuna+'</option>';
										$("#comuna").html(comuna);
									}else{
										$("#region").trigger('change');
									}

									if(data.id_centro_salud != '0'){
										var centro_salud = '<option value="'+data.id_centro_salud+'">'+data.gl_centro_salud+'</option>';
										$("#centrosalud").html(centro_salud);
									}else{
										$("#comuna").trigger('change');
									}

									$('#form').find('input, textarea, checkbox, select').attr('disabled',true);	
									if(data.bo_reconoce == '1'){
										$("#chkReconoce").prop("checked", true);
									}else{
										$("#chkReconoce").prop("disabled", false);
									}
									if(data.bo_acepta_programa == '1'){
										$("#chkAcepta").prop("checked", true);
									}else{
										$("#chkAcepta").prop("disabled", false);
									}
									$( "#id_registro" ).prop( "disabled", false );
									$( "#motivoconsulta" ).prop( "disabled", false );
									$( "#fechaingreso" ).prop( "disabled", false );
									$( "#horaingreso" ).prop( "disabled", false );

									$("#guardar").hide();
									$("#guardarMotivo").show();
								} else {
									xModal.info('Sin registro en el sistema.');
									$("#guardarMotivo").hide();
									$("#guardar").show();
								}
					}
				});
			}else{
				xModal.info("Debe ingresar un RUT");
			}
		},
				
		cargarCentroSaludporComuna : function(comuna,combo,centrosalud){
			if(comuna != 0){
				$.post(BASE_URI+'index.php/Registro/cargarCentroSaludporComuna',{comuna:comuna},function(response){
					if(response.length > 0){
						var total = response.length;
						var options = '<option value="0">Seleccione un Centro de Salud</option>';
						for(var i=0; i<total; i++){
							if(centrosalud == response[i].id_establecimiento){
								options += '<option value="'+response[i].id_establecimiento+'" selected >'+response[i].nombre_establecimiento+'</option>';	
							}else{
								options += '<option value="'+response[i].id_establecimiento+'">'+response[i].nombre_establecimiento+'</option>';
							}
							
						}
						$('#'+combo).html(options);
					}
				},'json');
			}else{
						$('#'+combo).html('<option value="0">Seleccione un Centro de Salud</option>');
			}
		}
	};
    
	$(document).ready(function() {

		var mapa = new MapaFormulario("map");
		mapa.seteaIcono("static/images/referencia.png");
		mapa.seteaLongitud("-70.6504492");
		mapa.seteaLatitud("-33.4378305");
		mapa.seteaZoom(12);
		mapa.seteaPlaceInput("direccion");
		mapa.inicio();
		mapa.cargaMapa();

		mapa.setMarkerInputs();

	});