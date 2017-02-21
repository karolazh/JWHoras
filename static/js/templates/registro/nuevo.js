/* global BASE_URI */

//Formatea Fecha
function formattedDate(date) {
    var d = new Date(date || Date.now()),
        day = '' + d.getDate(),
        month = '' + (d.getMonth() + 1),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('/');
}

var Registro ={
    
cargarRegistro : function(){
            rut = document.getElementById('rut').value;
            console.log(rut);
		if(rut != ""){
			$.post(BASE_URI+'index.php/Registro/cargarRegistro',{rut:rut},function(response){
				if(response.length > 0){
                                        document.getElementById('nombres').value = response[0].nombres;
                                        document.getElementById('apellidos').value = response[0].apellidos;
                                        document.getElementById('fecnacim').value = response[0].fec_nac;
                                        document.getElementById('prevision').value = response[0].prevision;
                                        document.getElementById('convenio').value = response[0].convenio;
                                        document.getElementById('region').value = response[0].region;
                                        Region.cargarComunasPorRegion(response[0].region,'comuna');
                                        document.getElementById('comuna').value = response[0].comuna;
                                        //Convertir Edad
                                        fecha = new Date(response[0].fec_nac);
                                        hoy = new Date();
                                        ed = parseInt((hoy -fecha)/365/24/60/60/1000);
                                        if (ed >= 0)
                                            {document.getElementById('edad').value = ed;}
                                }else{
                                    alert("No se encontró Paciente con rut: "+rut);
                                }
			},'json');
		}else{
                    alert("No se ha ingresado rut");
		}
            },
            
cargarCentroSaludporComuna : function(comuna,combo,centrosalud){
            console.log(comuna);
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
            mapa.inicio();
            mapa.cargaMapa();

            //if($("#eme_id").val()!=""){
                mapa.setMarkerInputs();
            //}



});




