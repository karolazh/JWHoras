/* global BASE_URI */

var Region ={
    
cargarComunasPorRegion : function(region,combo,comuna){
            console.log(region);
		if(region != 0){
			$.post(BASE_URI+'index.php/Regiones/cargarComunasPorRegion',{region:region},function(response){
				if(response.length > 0){
					var total = response.length;
					var options = '<option value="0">Seleccione una Comuna</option>';
					for(var i=0; i<total; i++){
						if(comuna == response[i].id_comuna){
							options += '<option value="'+response[i].id_comuna+'" selected >'+response[i].nombre_comuna+'</option>';	
						}else{
							options += '<option value="'+response[i].id_comuna+'">'+response[i].nombre_comuna+'</option>';
						}
						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
                    $('#'+combo).html('<option value="0">Seleccione una Comuna</option>');
		}
	},
	
cargarOficinaPorProvincia : function(provincias,combo,oficinas){		 
		if(region != 0){
			$.post(BASE_URI + 'index.php/MantenedorPlanificacion/cargarOficinaPorProvincia',{provincias:provincias},function(response){
				  if(response.length > 0){
					var total = response.length;					
					var options = '<option value="0">-- Seleccione --</option>';
					for(var i=0; i<total; i++){
						if(oficinas == response[i].id_oficina){
							options += '<option value="'+response[i].id_oficina+'" selected >'+response[i].nombre_oficina+'</option>';	
						}else{
							options += '<option value="'+response[i].id_oficina+'">'+response[i].nombre_oficina+'</option>';
						}						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
			$('#'+combo).html('').trigger('onchange');
		}
	}

};