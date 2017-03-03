

	function detalle(id){
		$('.modal-body').html("CARGANDO DATOS...Tardaré un par de segundos");
		$('.modal-body').load("index.php/Instalacion/detalleInstalacion/"+id);
		$('#myModal').modal('show');			
	}	
	
	function updateFileData(form){
			$.post("index.php/AdjuntosInstalacion/guardarCambios/",eval("$('#"+form+"').serialize()"),function(response){
				if($.trim(response) == "1"){	
					alert("Guardado");
				}else{
					alert("Problemas al guardar \n::"+response+"::");
				}
			});
	}	
	
	function updateFileDataSilencio(form){
			$.post("index.php/AdjuntosInstalacion/guardarCambios/",eval("$('#"+form+"').serialize()"),function(response){
				if($.trim(response) == "1"){	
					//alert("Guardado");
				}else{
					alert("Problemas al guardar \n::"+response+"::");
				}
			});
	}		
	
	function deleteFile(form,bloque){
			$.post("index.php/AdjuntosInstalacion/eliminarADjunto/",eval("$('#"+form+"').serialize()"),function(response){
				if($.trim(response) == "1"){	
					//alert("Eliminado");
					eval("$('#"+bloque+"').hide('slow')");
				}else{
					alert("Problemas al eliminar \n::"+response+"::");
				}
			});
	}		
	
	function cambiarTipo(form,div,tipo){
			$.post("index.php/AdjuntosInstalacion/cambiarTipo/","form="+form+"&tipo="+tipo+"&div="+div,function(response){
				eval("$('#"+div+"').html(response)");
			});
	}		
	

	
	function subirArchivos(form,idAmbito){
		
		event.preventDefault();
        data = new FormData($('#'+form)[0]);
		
		if($("#"+form+" input[name=nuevo_archivo]").val() != "" && $("#"+form+" select[name=id_tipo]").val() != 0){
		
			$.ajax({
				type: 'POST',
				data: data,
				cache: false,
				contentType: false,
				processData: false
			}).done(function(data) {
				location.reload();
			}).fail(function(jqXHR,status, errorThrown) {
				alert("Problemas al cargar archivo");
			});	
		}else{
			alert("Debe seleccionar un archivo a cargar y su tipo "+idAmbito);
		}			
		
		
	}
	
$(document).ready(function(){
	
	//form_nuevo_adjunto
	
	$('#btn_subir_adjunto').on('click', function(e) {			
		e.preventDefault();
        data = new FormData($('#form_nuevo_adjunto')[0]);

		if($("#nuevo_archivo").val() != ""){
		
			$.ajax({
				type: 'POST',
				data: data,
				cache: false,
				contentType: false,
				processData: false
			}).done(function(data) {
				location.reload();
			}).fail(function(jqXHR,status, errorThrown) {
				alert("Problemas al cargar archivo");
			});	
		}else{
			alert("Debe seleccionar un archivo a cargar");
		}	
	});			
	
	$('#botones_tipo_busqueda_volver').on('click', function(e) {		
		$("#botones_tipo_busqueda").slideDown("slow");	
		$("#botones_tipo_busqueda_volver").hide("slow");	
	});

	//Control de paneles
	
	$('#region').on('change', function(e) {		
		$('#id_comuna').load("index.php/Comuna/listaComuna/"+$(this).val());		
	});	
	
	$('#panel_rut').on('click', function(e) {		
		$("#botones_tipo_busqueda_volver").show("slow");
		$("#botones_tipo_busqueda").slideUp("slow");
		
		$(".div_busqueda").hide();
		$("#div_resultado").show();
		$("#div_rut").show();		
	});

	$('#panel_mapa').on('click', function(e) {		
		$("#botones_tipo_busqueda_volver").show("slow");
		$("#botones_tipo_busqueda").slideUp("slow");	
		
		$("#div_resultado").empty();
		
		$(".div_busqueda").hide(0, function(){
			$("#div_mapa").show();
		});
	});		
	
	$('#panel_direccion').on('click', function(e) {		

		$("#botones_tipo_busqueda_volver").show("slow");
		$("#botones_tipo_busqueda").slideUp("slow");
	
		$("#div_resultado").empty();
		
		$(".div_busqueda").hide(0, function(){
			$("#div_direccion").show();
		});
	});	
	
	//Fin control de paneles
	
	$('#btn_rut').on('click', function(e) {		
	
		var error = "";
		
		if($("#rut").val() == ""		){ 
			error = "- Debe ingresar un rut\n" 
		}		
		
		if(error == ""){
			$.post("index.php/home/buscarRut/",$( "#form_buscar" ).serialize(),function(response){
				$('#div_resultado').html(response);
				$('#tablaPrincipal').DataTable();
				$("#div_resultado").show();				
			});

		}else{
			alert("Por favor revisar: \n\n" + error);
		}			
		
		
		$("#div_resultado").show();
	});		

	$('#btn_direccion').on('click', function(e) {		

		var error = "";
		
		if($("#region").val() == ""		){ 
			error = "- Debe seleccionar una región\n" 
		}
		
		if($("#id_comuna").val() == "" || $("#id_comuna").val() == null){ 
			error = error + "- Debe seleccionar una comuna\n" 
		}
		if($("#gl_calle").val() == "" 	){ 
			error = error + "- Debe ingresar una calle\n" 
		}
		/*
		if($("#nr_numero").val() == "" 	){ 
			error = error + "- Debe ingresar un número\n" 
		}		
		*/
		if(error == ""){
			$.post("index.php/home/buscarDireccion/",$( "#form_buscar" ).serialize(),function(response){
				$('#div_resultado').html(response);
				$('#tablaPrincipal').DataTable();
				$("#div_resultado").show();				
			});

		}else{
			alert("Por favor revisar: \n\n" + error);
		}	
	});			

	

	
	
});


