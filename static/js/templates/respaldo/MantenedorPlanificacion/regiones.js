var Regiones ={

cargarComunasPorRegion : function(region,combo,provincias){		 
		if(region != 0){
			$.post(BASE_URI + 'index.php/MantenedorPlanificacion/cargarComunasPorRegion',{region:region},function(response){
				  if(response.length > 0){
					var total = response.length;					
					var options = '<option value="0">-- Seleccione --</option>';
					for(var i=0; i<total; i++){
						if(provincias == response[i].id_provincia){
							options += '<option value="'+response[i].id_provincia+'" selected >'+response[i].nombre_provincias+'</option>';	
						}else{
							options += '<option value="'+response[i].id_provincia+'">'+response[i].nombre_provincias+'</option>';
						}						
					}
					$('#'+combo).html(options);
				}
			},'json');
		}else{
			$('#'+combo).html('').trigger('onchange');
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