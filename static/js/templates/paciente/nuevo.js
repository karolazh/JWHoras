/* global BASE_URI */
$("#guardar").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();
	var gl_rut = $("#rut").val();
	if (gl_rut == '' && !$('#chkextranjero').is(':checked')) {
		xModal.danger('- El campo RUT es Obligatorio');
	} else if ($('#chkextranjero').is(':checked') && $('#opcionPrevision').val() === "1" && $('#gl_codigo_fonasa').val() === "") {
		xModal.danger('Si eres extranjero afiliado en FONASA, deber ingresar tu código fonasa y subir tu certifiado de afiliación');
	} else if ($( "#region option:selected" ).val() === "0"){
		xModal.danger('Debe seleccionar la region del paciente.');
	} else if ($( "#comuna option:selected" ).val() === "0"){
		xModal.danger('Debe seleccionar la comuna del paciente.');
	} 
	
		else {
		if ($('#chkextranjero').is(':checked')) {
			parametros.push({
				"name": 'chkextranjero',
				"value": 1
			});
		} else {
			parametros.push({
				"name": 'chkextranjero',
				"value": 0
			});
		}
		if ($('#chkAcepta').is(':checked')) {
			parametros.push({
				"name": 'chkAcepta',
				"value": 1
			});
		} else {
			parametros.push({
				"name": 'chkAcepta',
				"value": 0
			});
		}
		if ($('#chkReconoce').is(':checked')) {
			parametros.push({
				"name": 'chkReconoce',
				"value": 1
			});
		} else {
			parametros.push({
				"name": 'chkReconoce',
				"value": 0
			});
		}
		if ($('#fono_seguro').is(':checked')) {
			parametros.push({
				"name": 'fono_seguro',
				"value": 1
			});
		} else {
			parametros.push({
				"name": 'fono_seguro',
				"value": 0
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
			cache: false,
			async: true,
			data: parametros,
			type: "post",
			url: BASE_URI + "index.php/Paciente/GuardarRegistro",
			error: function (xhr, textStatus, errorThrown) {
				xModal.danger('Error: No se pudo Ingresar un nuevo Registro');
			},
			success: function (data) {
				if (data.correcto) {
					xModal.success('Éxito: Se Ingresó nuevo Registro!');
					setTimeout(function () {
						location.href = BASE_URI + "index.php/Paciente";
					}, 2000);
				} else {
					xModal.danger('Error: '+ data.mensaje_error);
				}
			}
		});
	}
	buttonEndProcess(button_process);

});

$("#guardarMotivo").on('click', function (e) {
	if (!$('#chk_confirma_dir').is(':checked')) {
		xModal.danger('Debe confirmar la Dirección del Paciente antes de poder Guardar.');
	} else if (!$('#chk_confirma_fono').is(':checked')) {
		xModal.danger('Debe confirmar el Teléfono del Paciente antes de poder Guardar.');
	} else if ($( "#region option:selected" ).val() === "0"){
		xModal.danger('Debe seleccionar la region del paciente.');
	} else if ($( "#comuna option:selected" ).val() === "0"){
		xModal.danger('Debe seleccionar la comuna del paciente.');
	} else {
	var button_process = buttonStartProcess($(this), e);
	var parametros = $("#form").serializeArray();
	var edad = $("#edad").val();
	var rut = $("#rut").val();
	var gl_grupo_tipo = $("#gl_grupo_tipo").val();
	var prevision = $("#prevision").val();
	var centrosalud = $("#centrosalud").val()
	var gl_latitud = $("#gl_latitud").val();
	var gl_longitud = $("#gl_longitud").val();
	var chk_confirma_fono = $("#chk_confirma_fono").val();
	var chk_confirma_dir = $("#chk_confirma_dir").val();
	var cambio_direccion = $("#cambio_direccion").val();
	if ($('#chkAcepta').is(':checked')) {
		parametros.push({
			"name": 'chkAcepta',
			"value": 1
		});
	} else {
		parametros.push({
			"name": 'chkAcepta',
			"value": 0
		});
	}
	if ($('#chkReconoce').is(':checked')) {
		parametros.push({
			"name": 'chkReconoce',
			"value": 1
		});
	} else {
		parametros.push({
			"name": 'chkReconoce',
			"value": 0
		});
	}
	if ($('#fono_seguro').is(':checked')) {
			parametros.push({
				"name": 'fono_seguro',
				"value": 1
			});
		} else {
			parametros.push({
				"name": 'fono_seguro',
				"value": 0
			});
		}
	parametros.push({
			"name": 'chk_confirma_fono',
			"value": chk_confirma_fono
	});
	parametros.push({
			"name": 'chk_confirma_dir',
			"value": chk_confirma_dir
	});
	parametros.push({
		"name": 'cambio_direccion',
		"value": cambio_direccion //variable global JS
	});
	parametros.push({
		"name": 'gl_grupo_tipo',
		"value": gl_grupo_tipo
	});
	parametros.push({
		"name": 'edad',
		"value": edad
	});
	parametros.push({
		"name": 'rut',
		"value": rut
	});
	parametros.push({
		"name": 'centrosalud',
		"value": centrosalud
	});
	parametros.push({
		"name": 'prevision',
		"value": prevision
	});
	parametros.push({
		"name": 'gl_latitud',
		"value": gl_latitud
	});
	parametros.push({
		"name": 'gl_longitud',
		"value": gl_longitud
	});
	
	$.ajax({
		dataType: "json",
		cache: false,
		async: true,
		data: parametros,
		type: "post",
		url: BASE_URI + "index.php/Paciente/GuardarMotivo",
		error: function (xhr, textStatus, errorThrown) {
						xModal.danger('Error: No se pudo agregar el Registro');
			alert('HTTP Error: '+errorThrown);
		},
		success: function (data) {
			if (data.correcto) {

							xModal.success('Éxito: Se Ingresó nuevo Registro!');
				setTimeout(function () {
					location.href = BASE_URI + "index.php/Paciente";
				}, 2000);
			} else {
							xModal.info('Error: No se pudo agregar el Registro.<br>Favor contacte con Mesa de Ayuda');
			}
		}
	});
	buttonEndProcess(button_process);
	}
});

$("#guardarReconoce").on('click', function (e) {
	var button_process = buttonStartProcess($(this), e);
		var id_paciente			= $(this).attr("data");

	$.ajax({
		dataType: "json",
		cache: false,
		async: true,
			data	: {id_paciente:id_paciente},
		type: "post",
		url: BASE_URI + "index.php/Paciente/GuardarReconoce",
		error: function (xhr, textStatus, errorThrown) {
			xModal.danger('Error: No se pudo guardar');
		},
		success: function (data) {
			if (data.correcto) {
				xModal.success('Éxito: información guardada!');
				setTimeout(function () {
					location.href = BASE_URI + "index.php/Paciente";
				}, 2000);
			} else {
				xModal.info('Error:  No se pudo guardar');
			}
		}
	});
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

$("#chkAcepta").on('click', function (e) {
	if ($('#chkAcepta').is(':checked')) {
		$('#files').show();
	} else {
		$('#files').hide();
	}
});

$("#direccion").on("change paste keyup ", function() {
	
	if($('#centrosalud').is('[disabled=disabled]')){
		$('#form').find('#centrosalud').attr('disabled', false);
		$("#cambio_direccion").val("1"); //variable global JS
	}
	
});

$("#region").on('change', function (e) {
	
	if($('#centrosalud').is('[disabled=disabled]')){
		$('#form').find('#centrosalud').attr('disabled', false);
		$("#cambio_direccion").val("1"); //variable global JS
	}
	
});
$("#comuna").on('change', function (e) {
	
	if($('#centrosalud').is('[disabled=disabled]')){
		$('#form').find('#centrosalud').attr('disabled', false);
		$("#cambio_direccion").val("1");//variable global JS
	}
	
});


	var Base64Binary = {
		/* Ejemplo de uso
			var uintArray	= Base64Binary.decode(data);  
			var byteArray	= Base64Binary.decodeArrayBuffer(data);
		*/
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
		
		/* will return a  Uint8Array type */
		decodeArrayBuffer: function(input) {
			var bytes = (input.length/4) * 3;
			var ab = new ArrayBuffer(bytes);
			this.decode(input, ab);
			
			return ab;
		},

		removePaddingChars: function(input){
			var lkey = this._keyStr.indexOf(input.charAt(input.length - 1));
			if(lkey == 64){
				return input.substring(0,input.length - 1);
			}
			return input;
		},

		decode: function (input, arrayBuffer) {
			//get last chars to see if are valid
			input = this.removePaddingChars(input);
			input = this.removePaddingChars(input);

			var bytes = parseInt((input.length / 4) * 3, 10);
			
			var uarray;
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			var j = 0;
			
			if (arrayBuffer)
				uarray = new Uint8Array(arrayBuffer);
			else
				uarray = new Uint8Array(bytes);
			
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
			
			for (i=0; i<bytes; i+=3) {	
				//get the 3 octects in 4 ascii chars
				enc1 = this._keyStr.indexOf(input.charAt(j++));
				enc2 = this._keyStr.indexOf(input.charAt(j++));
				enc3 = this._keyStr.indexOf(input.charAt(j++));
				enc4 = this._keyStr.indexOf(input.charAt(j++));
		
				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;
		
				uarray[i] = chr1;			
				if (enc3 != 64) uarray[i+1] = chr2;
				if (enc4 != 64) uarray[i+2] = chr3;
			}
		
			return uarray;	
		}
	}

    $("#btnDescarga").on('click', function(e) {
		var button_process	= buttonStartProcess($(this), e);
        var parametros		= $("#form").serializeArray();
        var gl_rut			= $("#rut").val();
		var inputextranjero	= $("#inputextranjero").val();

		if(rut == '' && inputextranjero == ''){			
			xModal.info('Debe ingresar un RUT o un Pasaporte.');
		}else{

			$.ajax({
				dataType: "json",
				cache	:false,
				async	: true,
				data	: parametros,
				type	: "post",
				url		: BASE_URI + "index.php/Paciente/generarConsentimiento", 
				error	: function(xhr, textStatus, errorThrown){
							xModal.danger('Error: No se ha podido generar el PDF.<br> Favor informar a Mesa de Ayuda.');
				},
				success	: function(data){
							if(data.correcto){
								var byteArray	= Base64Binary.decodeArrayBuffer(data.base64);
								var blob		= new Blob([byteArray], {type: 'application/pdf'});
								var link		= document.createElement('a');
								link.href		= window.URL.createObjectURL(blob);
								link.download	= data.filename;
								link.click();
							}else{
								xModal.danger('No se ha podido generar el PDF.<br> Favor informar a Mesa de Ayuda.');
							}
				}
			});
		}
		buttonEndProcess(button_process);
    });

	//Formatea Fecha
	function formattedDate(date) {
		var d		= new Date(date || Date.now()),
			day		= '' + d.getDate(),
			month	= '' + (d.getMonth() + 1),
			year	= d.getFullYear();

	if (month.length < 2)
		month = '0' + month;
	if (day.length < 2)
		day = '0' + day;

	return [day, month, year].join('/');
}

var Paciente = {
	cargar: function () {
		var rut = $("#rut").val();
		var inputextranjero = $("#inputextranjero").val();
		if (rut != "" || inputextranjero != "") {

			$.ajax({
				dataType: "json",
				cache: false,
				async: true,
				data: {rut: rut, inputextranjero: inputextranjero},
				type: "post",
				url: BASE_URI + "index.php/Paciente/cargarPaciente",
				error: function (xhr, textStatus, errorThrown) {
					xModal.danger('Error al Buscar');
				},
				success: function (data) {
					if (data.correcto) {

						var str_ult_cinco_reg = "";
						if (data.count_motivos > 5) {
							str_ult_cinco_reg = "Mostrando los 5 últimos Registros.";
						}
						if (data.count_motivos == 1) {
							xModal.success('Paciente se encuentra con ' + data.count_motivos + ' Registro en la Plataforma, con fecha ' + data.fc_ultimo_motivos + '.<br>La información del Paciente ha sido cargada. <br> Motivo de consulta : <br>' + data.div_superior + data.tabla_motivos + data.div_inferior);
							$("#div_tabla_motivos").html(data.tabla_motivos);
							$("#mostrar_motivos_consulta").show();
						} else {
							xModal.success('Paciente se encuentra con ' + data.count_motivos + ' Registros en la Plataforma, siendo el último de fecha ' + data.fc_ultimo_motivos + '.<br>La información del Paciente ha sido cargada. ' + str_ult_cinco_reg + '<br> Motivos de consulta : <br>' + data.div_superior + data.tabla_motivos + data.div_inferior);
							$("#div_tabla_motivos").html(data.tabla_motivos);
							$("#mostrar_motivos_consulta").show();
						}
						if (data.count_direcciones > 1) {
							$("#groupTablaDirecciones").html(data.tabla_direcciones);
							$("#groupTablaDirecciones").show();
						}
						$("#btnBitacora").attr("onclick","xModal.open('"+BASE_URI + "index.php/Paciente/bitacora/"+data.id_paciente+"', 'Registro número : "+data.id_paciente+"', 85);");
						$("#id_paciente").val(data.id_paciente);
						$("#gl_grupo_tipo").val(data.gl_grupo_tipo);
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

						if (data.id_comuna != '0') {
							//var comuna = '<option value="' + data.id_comuna + '">' + data.gl_nombre_comuna + '</option>';
							$("#comuna").html(data.jsonComuna);
						} else {
							$("#region").trigger('change');
						}

						if (data.id_centro_salud != '0') {
							//var centro_salud = '<option value="' + data.id_centro_salud + '">' + data.gl_centro_salud + '</option>';
							$("#centrosalud").html(data.jsonCentroSalud);
						} else {
							$("#comuna").trigger('change');
						}

						$('#form').find('input, textarea, checkbox, select').attr('disabled', true);
						$('#form').find('#direccion')						.attr('disabled', false);
						$('#form').find('#region')							.attr('disabled', false);
						$('#form').find('#comuna')							.attr('disabled', false);
						$('#form').find('#fono')							.attr('disabled', false);
						$('#form').find('#chk_confirma_fono')				.attr('disabled', false);
						$('#form').find('#chk_confirma_dir')				.attr('disabled', false);
						$('#form').find('#fono_seguro')						.attr('disabled', false);
						if (data.bo_reconoce == '1') {
							$("#chkReconoce").prop("checked", true);
						} else {
							$("#chkReconoce").prop("disabled", false);
						}
						if (data.bo_acepta_programa == '1') {
							$("#chkAcepta").prop("checked", true);
						} else {
							$("#chkAcepta").prop("disabled", false);
						}
						if (data.bo_fono_seguro == '1') {
							$("#fono_seguro").prop("checked", true);
						} else {
							$("#fono_seguro").prop("disabled", false);
						}
						$("#id_paciente").prop("disabled", false );
						$("#motivoconsulta").prop("disabled", false);
						$("#fechaingreso").prop("disabled", false);
						$("#horaingreso").prop("disabled", false);

						$('#guardar').hide();
						$('#guardarMotivo').show();
						$("#btnBitacora").show();
						$('#groupConfirmaFono').removeClass("hidden");
						$('#groupConfirmaDir').removeClass("hidden");
					} else {
						$('#guardar').show();
						$('#guardarMotivo').hide();
						$("#btnBitacora").hide();
						xModal.info('Nuevo Paciente');
					}
				}
			});
		} else {
			if ($('#chkextranjero').is(':checked') && inputextranjero === ""){
				xModal.info("Debe ingresar un RUT o un Pasaporte");
			}
		}
	},
	cargarCentroSaludporComuna: function (comuna, combo, centrosalud) {
		if (comuna != 0) {
			$.post(BASE_URI + 'index.php/Paciente/cargarCentroSaludporComuna', {comuna: comuna}, function (response) {
				var options = '<option value="0">Seleccione un Centro de Salud</option>';
				$.each(response, function (i, valor) {
					if (centrosalud == valor.id_centro_salud) {
						options += '<option value="' + valor.id_centro_salud + '" selected >' + valor.gl_nombre_establecimiento + '</option>';
					} else {
						options += '<option value="' + valor.id_centro_salud + '">' + valor.gl_nombre_establecimiento + '</option>';
					}
				});
				$('#' + combo).html(options);

			}, 'json');
		} else {
			$('#' + combo).html('<option value="0">Seleccione un Centro de Salud</option>');
		}
	}
};

function guardarAdjunto(form, btn) {
	btn.disabled = true;
	var btnTexto = $(btn).html();
	$(btn).html('Guardando...');

	if (form.adjunto.value == "") {
		xModal.warning('Error: Debe seleccionar un archivo para adjuntarlo');
		$(btn).html(btnTexto).attr('disabled', false);
	} else {
		extensiones_permitidas = new Array('.jpeg', '.jpg', '.png', '.gif', '.tiff', '.bmp', '.pdf', '.txt', '.csv', '.doc', '.docx', '.ppt', '.pptx', '.xls', '.xlsx');
		permitida = false;
		string = form.adjunto.value;
		extension = (string.substring(string.lastIndexOf("."))).toLowerCase();

		for (var i = 0; i < extensiones_permitidas.length; i++) {
			if (extensiones_permitidas[i] == extension) {
				permitida = true;
				break;
			}
		}

		if (!permitida) {
			xModal.warning('El Tipo de archivo que intenta subir no está permitido.<br><br>Favor elija un archivo con las siguientes extensiones: <br>' + extensiones_permitidas.join(' '));
			$(btn).html(btnTexto).attr('disabled', false);
		} else {
			$(form).submit();
		}
	}
}

function cargarListadoAdjuntos() {
	$.post(BASE_URI + 'index.php/Paciente/cargarListadoAdjuntos', function (response)
	{
		parent.$("#listado-adjuntos").html(response).show();
	});
}

function borrarAdjunto(adjunto) {
	$.post(BASE_URI + 'index.php/Paciente/borrarAdjunto/' + adjunto, function (response)
	{
		$("#listado-adjuntos").html(response);
	});
}

$(document).ready(function () {

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

function mostrarFonasaExtranjero(id_prevision) {
	if ($('#chkextranjero').is(':checked')) {
		if (id_prevision === "1") {
			$('#groupFonasaExtranjero').removeClass("hidden");
		} else {

			$('#groupFonasaExtranjero').addClass("hidden");
		}
	} else {
		$('#groupFonasaExtranjero').addClass("hidden");
	}
}


