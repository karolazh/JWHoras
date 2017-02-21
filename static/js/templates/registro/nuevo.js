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

var Pacientes ={
    
cargarPaciente : function(){
            rut = document.getElementById('rut').value;
            console.log(rut);
		if(rut != ""){
			$.post(BASE_URI+'index.php/Registro/cargarPaciente',{rut:rut},function(response){
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
	}
    }
    
/*$(document).ready(function() {
    $("#buscar").on('click', function(e) {
        var button_process = buttonStartProcess($(this), e);
        var parametros = new FormData(document.getElementById('rut'));
        console.log(parametros);
        $.ajax({         
            dataType: "json",
            cache:false,
            contentType: false,
            processData:false,
            async: true,
            data: parametros,
            type: "post",
            url: BASE_URI + "index.php/Dau/cargarPaciente", 
            error: function(xhr, textStatus, errorThrown){

            },
            success:function(data){
                buttonEndProcess(button_process);
                if(data.correcto){
                    alert("if correcto");
                } else {
                    procesaErrores(data.error);
                    alert("else incorrecto")
                }
            }
        }); 
    }); 
});

*/