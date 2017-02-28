/* global BASE_URI */

var Registro = {

    guardarNuevoAdjunto: function (form, btn) {
        /*
         realizar validacion formulario
         */
        //btn.disabled = true;
        
        var idreg = form.idreg.value;
        var tipodoc = form.tipoDoc.value;
        var path = form.archivo.value;
        var comentario = form.comentario_adjunto.value;
        
        /* obtiene nombre de documento a guardar para nombre de archivo */
        var tipotxt = tipoDoc.options[tipoDoc.selectedIndex].text;
        //alert(tipoDoc.options[tipoDoc.selectedIndex].text);
        
        /* nombre de tipo de documento a mayusculas*/
        tipotxt = tipotxt.toUpperCase();
        //alert(tipotxt);
        
        /* obtiene extensión de archivo */
        var ext = path.slice((path.lastIndexOf(".") - 1 >>> 0) + 2);
        ext = ext.toUpperCase();
        //alert(ext);
        
        /* obtiene fecha y hora */
        var fecha = new Date();
        /* formatea fecha */
        var year  = fecha.getFullYear().toString();
        var day = fecha.getDate().toString();
        var month = "";
        if ((fecha.getMonth()+1) < 10) {
            month = "0" + month.toString(); 
        } else {
            month = month.toString(); 
        }
        var fechaformat = year +  month + day;
        /* formatea hora */
        var hora = fecha.getHours();
        var min  = fecha.getMinutes();
        var seg  = fecha.getSeconds();
        var horaformat = hora.toString() + min.toString() + seg.toString();
        
        /* nuevo nombre de archivo */
        var archivo = fechaformat + "_" + horaformat + "_" + tipotxt + "." + ext;
        //alert(archivo);
        
        var error = false;
        var msg_error = '';
        
        if (tipodoc == 0) {
            msg_error += 'Seleccione Tipo de documento<br/>';
            error = true;
        }
        
        if (path == "") {
            msg_error += 'Seleccione Archivo<br/>';
            error = true;
        }
        
        alert(idreg)
        if (error) {
            xModal.danger(msg_error,function(){
                //btn.disabled = false;
            });
        } else {
            //var formulario = $(form).serialize();
            //alert(formulario);
            //alert(form.archivo.value);
            
            $.ajax({
                dataType: "json",
                cache	:false,
                async	: true,
                data	: {idreg:idreg, tipoDoc: tipodoc, archivo: path},
                type	: "post",
                url	: BASE_URI + 'index.php/Registro/guardarNuevoAdjunto', 
                error	: function(xhr, textStatus, errorThrown){
                            xModal.danger('Error: No se pudo guardar archivo');
                },
                success	: function(data){
                            if(data.correcto){
                                xModal.success('Éxito: información guardada!');
                                //setTimeout(function() { location.href = BASE_URI + "index.php/Registro"; }, 2000);
                            } else {
                                xModal.info('Error:  No se pudo guardar 2');
                            }
                }                
            });
            
            //var id_registro = $(this).attr("data");
            //data	: {id_registro:id_registro},
            //data	: {idreg:idreg, tipoDoc:tipodoc, archivo:path, comentario_adjunto:comentario},                
        }
    }
}