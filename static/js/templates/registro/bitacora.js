/* global BASE_URI */

    $("#guardar1").on('click', function(e) {
        xModal.danger('PRUEBA GUARDA COMENTARIO');
    });
    
    $("#guardar2").on('click', function(e) {
        xModal.danger('PRUEBA ADJUNTA ARCHIVO');
    });

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