/* global BASE_URI */

var Laboratorio = {
    
    buscarExamen: function (id_paciente_examen) {
	//console.log(id);
        var error = false;
        var msg_error = '';
        //alert(id_paciente_examen);
        //alert(BASE_URI + 'index.php/Laboratorio/buscarExamen/' + id_paciente_examen);
        
//        $.ajax({
//            url : BASE_URI + 'index.php/Laboratorio/buscarExamen/' + id_paciente_examen, 
//            processData : false,
//            cache : false,
//            async : true,
//            type : 'post',
//            dataType : 'json',
//            contentType : false,
//            success : function(response){
//                if(response.correcto == true){
//                    //xModal.success("OK: El archivo fue guardado", function(){
//                        habilitarExamen();
//                    //});
//                }
//                else{
//                    xModal.danger("ERROR: ",function(){
//                    });
//                }
//            }
//            , 
//            error : function(){
//                    xModal.danger('Error: Intente nuevamente',function(){
//                    });
//            }
//        });
    }
    ,
    guardarExamen: function (form) {
        var error = false;
        var msg_error = '';        
        
        var id_paciente_examen = form.id_paciente_examen.value;
        //alert(id_paciente_examen);
        var id_tipo_examen = form.id_tipo_examen.value;
        var id_paciente = form.id_paciente.value;
        var gl_folio = form.gl_folio.value; 
        var gl_rut_toma = form.gl_rut_toma.value;
        //alert(gl_rut_toma);
        var gl_nombre_toma = form.gl_nombre_toma.value;
        //alert(gl_nombre_toma);
        var fc_resultado = form.fc_resultado.value;
        //alert(fecha_resultado);
        var gl_resultado = form.gl_resultado.value;
        //alert(resultado);
        var gl_resultado_descripcion = form.gl_resultado_descripcion.value;
        //alert(descripcion);
        var gl_resultado_indicacion = form.gl_resultado_indicacion.value;
        //alert(indicacion);
        var resultado = "";
        
        if (gl_rut_toma == "") {
            msg_error += 'Ingrese RUT persona toma examen<br/>';
            error = true;
        }
        
        if (gl_nombre_toma == "") {
            msg_error += 'Ingrese Nombre persona toma examen<br/>';
            error = true;
        }
        
        if (fc_resultado == "") {
            msg_error += 'Ingrese Fecha de Resultado<br/>';
            error = true;
        }
        
        if (gl_resultado == "") {
            msg_error += 'Ingrese Resultado de Examen<br/>';
            error = true;
        } else {
            //valida si tipo de examen es VIH, VDRL, RPR
            if ((id_tipo_examen == 2) || (id_tipo_examen == 3) || (id_tipo_examen == 4)) {
                if (gl_resultado == 0) {
                    resultado = "P";
                } else {
                    resultado = "N";
                }
            } else {
                if (gl_resultado == 0) {
                    resultado = "N";
                } else {
                    resultado = "A";
                }
            }
        }
        
        if (gl_resultado_descripcion == "") {
            msg_error += 'Ingrese Descripción de Resultado<br/>';
            error = true;
        }
        
        if (gl_resultado_indicacion == "") {
            msg_error += 'Ingrese Indicación de Resultado<br/>';
            error = true;
        }
        
        if (error) {
            xModal.danger(msg_error,function(){
            });
        } else {
            var formulario = new FormData();
            formulario.append('id_paciente_examen', id_paciente_examen);
            formulario.append('id_tipo_examen', id_tipo_examen);
            formulario.append('id_paciente', id_paciente);
            formulario.append('gl_rut_toma', gl_rut_toma);
            formulario.append('gl_nombre_toma', gl_nombre_toma);
            formulario.append('gl_folio',gl_folio);
            formulario.append('fc_resultado', fc_resultado);
            formulario.append('gl_resultado', resultado);
            formulario.append('gl_resultado_descripcion', gl_resultado_descripcion);
            formulario.append('gl_resultado_indicacion', gl_resultado_indicacion);
            
            //console.log(formulario);
            $.ajax({
                url : BASE_URI + 'index.php/Laboratorio/guardarExamen', 
                data : formulario,
                processData : false,
                cache : false,
                async : true,
                type : 'post',
                dataType : 'json',
                contentType : false,
                success : function(response){
                    if(response.correcto == true){
                        xModal.success("OK: El Examen fue guardado", function(){
                            //recarga grilla de exámenes
                            $("#grilla-examenes").html(response.grilla);
                            xModal.closeAll();
                        });
                    }
                    else{
                        xModal.danger("ERROR: El Examen NO fue guardado",function(){
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