/* global BASE_URI */

var Agenda = {
    
    guardarAgenda: function (form) {
        var error = false;
        var msg_error = '';        
        
        var id_paciente = form.id_paciente.value;
        //alert(id_paciente);
        var id_empa = form.id_empa.value;
        //alert(id_empa);
        var id_centro_salud = form.id_centro_salud.value;
        //alert(id_centro_salud);
        var id_examen = form.id_examen.value;
        //alert(id_examen);
        var id_laboratorio = form.id_laboratorio.value;
        //alert(id_examen);
        
        //id de laboratorio seleccionado en combo si es "nuevo"
        var laboratorio = form.laboratorio.value;
        //id de examen seleccionado en combo si es "nuevo"
        var examen = form.examen.value;
        
        var fecha_agenda = form.fc_toma.value;
        //alert(fecha_agenda);
        var hora_agenda = form.gl_hora_toma.value;
        //alert(hora_agenda);
        var observacion = form.gl_observacion_toma.value;
        //alert(observacion);
        
        //Valida si está ingresando un examen nuevo o viene de EMPA
        if (id_examen == "") {
            if (examen == "0") {
                msg_error += 'Seleccione Tipo de Examen<br/>';
                error = true;
            }
        }
        
        //Valida si usuario loguedo es de tipo "Laboratorio"
        if (id_laboratorio == "") {
            if (laboratorio == "0") {
                msg_error += 'Seleccione Laboratorio<br/>';
                error = true;
            }
        }
        
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
            formulario.append('id_empa', id_empa);
            formulario.append('id_centro_salud', id_empa);            
            if (id_laboratorio == "") {
                formulario.append('id_laboratorio', laboratorio);
            } else {
                formulario.append('id_laboratorio', id_laboratorio);
            }
            if (id_examen == "") {
                formulario.append('id_examen', examen);
            } else {
                formulario.append('id_examen', id_examen);
            }
            formulario.append('fecha_agenda', fecha_agenda);
            formulario.append('hora_agenda', hora_agenda);
            formulario.append('observacion', observacion);

            //console.log(formulario);
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
                        $('#verAgenda_' + id_examen).hide();
                        $('#verExamen_' + id_examen).show();
						$('#id_paciente_examen_' + response.gl_examen).val(response.ultimo_id);
                        //alert(response.id_agenda);
                        //xModal.success("OK: El paciente fue agendado" + $('#verExamen_' + id_examen).val(), function(){
                        xModal.success("OK: El paciente fue agendado", function(){
                            //Valida si está ingresando un examen nuevo desde laboratorio...
                            //...para recargar grilla de exámenes
                            //if (id_examen == "") {
                                $("#grilla-examenes").html(response.grilla);
                            //}
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

// funcion para que funcione el calendario estilo ASD
$(function () {
    $(".datepicker").datetimepicker({
        locale: "es",
        format: "DD/MM/YYYY",
    });
});
//funcion para que funcione la seleccion de hora estilo ASD
 $(function () {
    $(".timepicker").datetimepicker({
        format: "LT"
    });
});