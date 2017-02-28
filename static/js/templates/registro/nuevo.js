/* global BASE_URI */

    $("#guardar").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();
        var gl_rut			= $("#rut").val();

		if(gl_rut == '' && !$('#chkextranjero').is(':checked')){
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
			/*
			var inputFileImage = document.getElementById("subirFile");
			var file = inputFileImage.files[0];
			var datos = new FormData();
			
			datos.append('archivo',file);
			parametros.push({
					"name"  : 'archivo',
					"value" : datos
				});
				*/
				
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
								setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
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
			url		: BASE_URI + "index.php/Registro/GuardarMotivo", 
			error	: function(xhr, textStatus, errorThrown){
						xModal.danger('Error: No se pudo agregar Motivo de Consulta');
			},
			success	: function(data){
						if(data.correcto){

							xModal.success('Éxito: Se Ingresó nuevo Motivo de Consulta!');
							setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
						} else {
							xModal.info('Error: No se pudo agregar Motivo de Consulta');
						}
			}
		});
		buttonEndProcess(button_process);

    });

    $("#guardarMotivo").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();

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
			url		: BASE_URI + "index.php/Registro/GuardarMotivo", 
			error	: function(xhr, textStatus, errorThrown){
						xModal.danger('Error: No se pudo agregar Motivo de Consulta');
			},
			success	: function(data){
						if(data.correcto){

							xModal.success('Éxito: Se Ingresó nuevo Motivo de Consulta!');
							setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
						} else {
							xModal.info('Error: No se pudo agregar Motivo de Consulta');
						}
			}
		});
		buttonEndProcess(button_process);

    });

    $("#guardarReconoce").on('click', function(e) {
        var button_process	= buttonStartProcess($(this), e);
		var id_registro			= $(this).attr("data");
		
		$.ajax({
			dataType: "json",
			cache	:false,
			async	: true,
			data	: {id_registro:id_registro},
			type	: "post",
			url		: BASE_URI + "index.php/Registro/GuardarReconoce", 
			error	: function(xhr, textStatus, errorThrown){
						xModal.danger('Error: No se pudo guardar');
			},
			success	: function(data){
						if(data.correcto){
							xModal.success('Éxito: información guardada!');
							setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
						} else {
							xModal.info('Error:  No se pudo guardar');
						}
			}
		});
		buttonEndProcess(button_process);
    });

	$("#chkextranjero").on('click', function(e) {
		if($('#chkextranjero').is(':checked')){
			$('#nacional').hide();
			$('#extranjero').show();
		}else{
			$('#nacional').show();
			$('#extranjero').hide();
		}
	});

	$("#chkAcepta").on('click', function(e) {
		if($('#chkAcepta').is(':checked')){
			$('#files').show();
		}else{
			$('#files').hide();
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
									if(data.count_motivos == 1){
										xModal.success('Paciente se encuentra con '+data.count_motivos+' Registro en la Plataforma, con fecha '+data.fc_ultimo_motivos+'.<br>Se procede a cargar la información.');
									}else{
										xModal.success('Paciente se encuentra con '+data.count_motivos+' Registros en la Plataforma, siendo el último de fecha '+data.fc_ultimo_motivos+'.<br>Se procede a cargar la información.');
									}

									$("#btnBitacora").attr("onclick","xModal.open('"+BASE_URI + "index.php/Registro/bitacora/"+data.id_registro+"', 'Registro número : "+data.id_registro+"', 85);");

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
										$("#chkReconoce").prop( "disabled", false );
									}
									if(data.bo_acepta_programa == '1'){
										$("#chkAcepta").prop("checked", true);
									}else{
										$("#chkAcepta").prop( "disabled", false );
									}
									$("#id_registro").prop("disabled", false );
									$("#motivoconsulta").prop("disabled", false );
									$("#fechaingreso").prop("disabled", false );
									$("#horaingreso").prop("disabled", false );
									
									$('#guardar').hide();
									$('#guardarMotivo').show();
									$("#btnBitacora").show();
								} else {
									$('#guardar').show();
									$('#guardarMotivo').hide();
									$("#btnBitacora").hide();
									xModal.info('Nuevo Paciente');
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

	function guardarAdjunto(form,btn){
		btn.disabled	= true;
		var btnTexto	= $(btn).html();
		$(btn).html('Guardando...');

		if(form.adjunto.value == ""){
			xModal.danger('Error: Debe seleccionar un archivo para adjuntarlo');
			$(btn).html(btnTexto).attr('disabled',false);			
		}else{
			$(form).submit();
		}
	}
	
	function cargarListadoAdjuntos(){
		$.post(BASE_URI+'index.php/Registro/cargarListadoAdjuntos',function(response)
		{			
			parent.$("#listado-adjuntos").html(response).show();
		});
	}

	function borrarAdjunto (adjunto){
		$.post(BASE_URI+'index.php/Registro/borrarAdjunto/'+adjunto,function(response)
		{
			$("#listado-adjuntos").html(response);
		});
	}

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