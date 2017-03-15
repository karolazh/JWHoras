/* global BASE_URI */

var Agenda = {
    
    guardarAgenda: function (form) {
        var error = false;
        var msg_error = '';        
        
        var id_paciente = form.id_paciente.value;
        //alert(idpac);
        var id_examen = form.id_examen.value;
        //alert(idpac);
        //var tipodoc = form.tipoDoc.value;
        //alert(tipodoc);
        /* descripción tipo doc */
        //var tipotxt = tipoDoc.options[tipoDoc.selectedIndex].text;
        /* nombre de tipo de documento a mayusculas*/
        //tipotxt = tipotxt.toUpperCase();
        
        //if (tipodoc == 0) {
        //    msg_error += 'Seleccione Tipo de documento<br/>';
        //    error = true;
        //}
        
        //if (error) {
        //    xModal.danger(msg_error,function(){
        //    });
        //} else {
            var formulario = new FormData();
            formulario.append('id_paciente', id_paciente);
            formulario.append('id_examen', id_examen);
            //formulario.append('tipodoc',tipodoc);
            //formulario.append('tipotxt',tipotxt);

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
        //}
    }
}