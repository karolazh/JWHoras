/* global BASE_URI */

var Laboratorio = {
    
    guardarExamen: function (form) {
        var error = false;
        var msg_error = '';        
        
        var id_paciente_examen = form.id_paciente_examen.value;
        var id_tipo_examen = form.id_tipo_examen.value;
        var id_paciente = form.id_paciente.value;
        var id_empa = form.id_empa.value;
        var gl_folio = form.gl_folio.value; 
        var gl_rut_toma = form.gl_rut_toma.value;
        var gl_nombre_toma = form.gl_nombre_toma.value;
        var fc_resultado = form.fc_resultado.value;
        var gl_resultado_descripcion = form.gl_resultado_descripcion.value;
        var gl_resultado_indicacion = form.gl_resultado_indicacion.value;
        
        if (gl_rut_toma == "") {
            msg_error += 'Ingrese RUT persona toma examen<br/>';
            error = true;
        }
        
        if (gl_nombre_toma == "") {
            msg_error += 'Ingrese Nombre persona toma examen<br/>';
            error = true;
        }
        
        if (fc_resultado == "") {
            msg_error += 'Ingrese Fecha resultado de examen<br/>';
            error = true;
        }

        var gl_glicemia = "";
        var gl_colesterol = "";
        var gl_pad = "";
        var gl_pas = "";
        if (id_tipo_examen == "1"){
            gl_glicemia = form.gl_glicemia.value;
            if (gl_glicemia == "") {
                msg_error += 'Ingrese Glicemia (mg/dl)<br/>';
                error = true;
            }
        } else {
            if (id_tipo_examen == "7"){
                gl_colesterol = form.gl_colesterol.value;
                if (gl_colesterol == "") {
                    msg_error += 'Ingrese Colesterol total (mg/dl)<br/>';
                    error = true;
                }
            } else {
                if (id_tipo_examen == "9") {
                    gl_pad = form.gl_pad.value;
                    gl_pas = form.gl_pas.value;
                    if ((gl_pad == "") && (gl_pas == "")){
                        msg_error += 'Ingrese Hipertensión PAS/PAD (mm/Hg)<br/>';
                        error = true;
                    }
                }
            }
        }
        
        var resultado = "";
        var gl_resultado = form.gl_resultado.value;
        if (gl_resultado == "") {
            msg_error += 'Ingrese Resultado examen<br/>';
            error = true;
        } else {
            //valida si tipo de examen es VIH, VDRL, RPR
            if ((id_tipo_examen == 2) || (id_tipo_examen == 3) || (id_tipo_examen == 4)) {
                if(gl_resultado == '0'){
                    resultado = "P";
                }else if(gl_resultado == '1'){
                    resultado = "N";
                }
            } else {
                if(gl_resultado == '0'){
                    resultado = "A";
                }else if(gl_resultado == '1'){
                    resultado = "N";
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
            formulario.append('id_empa', id_empa);
            formulario.append('gl_rut_toma', gl_rut_toma);
            formulario.append('gl_nombre_toma', gl_nombre_toma);
            formulario.append('gl_folio',gl_folio);
            formulario.append('fc_resultado', fc_resultado);
            formulario.append('gl_glicemia', gl_glicemia);
            formulario.append('gl_colesterol', gl_colesterol);
            formulario.append('gl_pad', gl_pad);
            formulario.append('gl_pas', gl_pas);
            formulario.append('gl_resultado', resultado);
            formulario.append('gl_resultado_descripcion', gl_resultado_descripcion);
            formulario.append('gl_resultado_indicacion', gl_resultado_indicacion);
            
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