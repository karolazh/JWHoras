/* global BASE_URI */

var Agenda = {
    
    guardarAgenda: function (form) {
        var error = false;
        var msg_error = '';        
        
        var id_paciente = form.id_paciente.value;
        //alert(id_paciente);
        var id_examen = form.id_examen.value;
        //alert(id_examen);
        var id_empa = form.id_empa.value;
        //alert(id_empa);
        var fecha_agenda = form.fc_toma.value;
        //alert(fecha_agenda);
        var hora_agenda = form.gl_hora_toma.value;
        //alert(hora_agenda);
        var observacion = form.gl_observacion_toma.value;
        //alert(observacion);
        
        if (fecha_agenda == "") {
            msg_error += 'Ingrese Fecha de Agenda<br/>';
            error = true;
        }
        
        if (observacion == "") {
            msg_error += 'Ingrese Observación<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
            });
        } else {
            var formulario = new FormData();
            formulario.append('id_paciente', id_paciente);
            formulario.append('id_examen', id_examen);
            formulario.append('id_empa', id_empa);
            formulario.append('fecha_agenda', fecha_agenda);
            formulario.append('hora_agenda', hora_agenda);
            formulario.append('observacion', observacion);

            console.log(formulario);
            $.ajax({
                url : BASE_URI + 'index.php/Agenda/guardarAgenda', 
                data : formulario,
                processData : false,
                cache : false,
                async : true,
                type : 'post',
                dataType : 'json',
                contentType : false,
                success : function(response){
                    if(response.correcto == true){
                        xModal.success("OK: El paciente fue agendado", function(){
                            xModal.closeAll();
                        });                        
                    }
                    else{
                        xModal.danger("ERROR: El paciente NO fue agendado",function(){
                        });
                    }
                }
                , 
                error : function(){
                        xModal.danger('Error: Intente nuevamente',function(){
                        });
                }
            });
        }
    }
}